<?php namespace Responsiv\Campaign\Models;

use Lang;
use Model;
use Event;
use Config;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\Controller as CmsController;
use October\Rain\Parse\Template as TextParser;

/**
 * Message Model
 */
class Message extends Model
{
    use \October\Rain\Parse\Syntax\SyntaxModelTrait;
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'responsiv_campaign_messages';

    /**
     * @var array Date fields
     */
    public $dates = ['launch_at', 'processed_at'];

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['syntax_data', 'syntax_fields', 'groups'];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|between:2,128',
        'page' => 'required'
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'status' => ['Responsiv\Campaign\Models\MessageStatus'],
    ];

    public $belongsToMany = [
        'subscriber_lists' => [
            'Responsiv\Campaign\Models\SubscriberList',
            'table' => 'responsiv_campaign_messages_lists',
            'otherKey' => 'list_id'
        ],
        'subscribers' => [
            'Responsiv\Campaign\Models\Subscriber',
            'table' => 'responsiv_campaign_messages_subscribers',
            'pivot' => ['sent_at', 'read_at', 'stop_at']
        ],
    ];

    public $attachMany = [
        'attachments' => ['System\Models\File']
    ];

    public function beforeCreate()
    {
        if (empty($this->subject)) {
            $this->subject = $this->name;
        }

        if (empty($this->status_id)) {
            $this->status_id = MessageStatus::getDraftStatus()->id;
        }

        if (empty($this->content)) {
            $this->rebuildContent();
        }
    }

    public function getUniqueCode($subscriber)
    {
        $value = $this->id.'!'.$subscriber->id;
        $hash = md5($value . '!' . $subscriber->email);
        return base64_encode($value.'!'.$hash);
    }

    public function getBrowserUrl($subscriber)
    {
        $code = $this->getUniqueCode($subscriber);
        return Page::url($this->page, ['code' => $code]);
    }

    /**
     * Rebuild and sync fields and data
     */
    public function rebuildContent()
    {
        $this->content = $this->getPageContent($this->page);
        $this->makeSyntaxFields($this->content);
        return $this;
    }

    /**
     * Rebuilds the statistics for the campaign
     * @return void
     */
    public function rebuildStats()
    {
        $this->count_subscriber = $this->subscribers()->count();
        $this->count_sent = $this->subscribers()->whereNotNull('sent_at')->count();
        $this->count_read = $this->subscribers()->whereNotNull('read_at')->count();
        $this->count_stop = $this->subscribers()->whereNotNull('stop_at')->count();
        return $this;
    }

    /**
     * Determines how many messages to send each hour, if staggered option is enabled.
     */
    public function getStaggerCount()
    {
        if (!$this->is_staggered) return -1;

        /*
         * Stagger by time
         */
        if ($this->stagger_type == 'time') {
            $spread = max(1, (int) $this->stagger_time);
            return ceil($this->count_subscriber / $spread);
        }

        /*
         * Stagger by count
         */
        return max(1, (int) $this->stagger_count);
    }

    public function duplicateCampaign()
    {
        $model = new self([
            'syntax_data'   => $this->syntax_data,
            'syntax_fields' => $this->syntax_fields,
            'groups'        => $this->groups,
            'page'          => $this->page,
            'content'       => $this->content,
            'name'          => $this->name,
            'subject'       => $this->subject,
            'is_staggered'  => $this->is_staggered,
            'stagger_type'  => $this->stagger_type,
            'stagger_time'  => $this->stagger_time,
            'stagger_count' => $this->stagger_count,
            'is_repeating'  => $this->is_repeating,
            'count_repeat'  => $this->count_repeat,
            'repeat_frequency' => $this->repeat_frequency,
        ]);

        $model->subscriber_lists = $this->subscriber_lists;
        return $model;
    }

    public function getIterativeNameAttribute()
    {
        if ($this->is_repeating) {
            return $this->name . ' (#'.$this->count_repeat.')';
        }

        return $this->name;
    }

    //
    // Tag processing
    //

    /**
     * Returns all available tags for parsing and their descriptions.
     */
    public static function getAvailableTags()
    {
        return [
            'first_name'      => "Subscriber's first name",
            'last_name'       => "Subscriber's last name",
            'email'           => "Subscriber's email address",
            'unsubscribe_url' => "Link to unsubscribe from emails",
            'browser_url'     => "Link to open web-based version"
        ];
    }

    /**
     * Returns an array of tag data for this message and the subscriber.
     */
    public function buildTagData($subscriber)
    {
        $data = [];

        $data['first_name'] = $subscriber->first_name;
        $data['last_name'] = $subscriber->last_name;
        $data['email'] = $subscriber->email;
        $data['unsubscribe_url'] = $this->getBrowserUrl($subscriber).'?unsubscribe=1';
        $data['browser_url'] = $this->getBrowserUrl($subscriber);
        $data['tracking_pixel'] = $this->getTrackingPixelImage($subscriber);
        $data['tracking_url'] = $this->getBrowserUrl($subscriber).'.png';

        return $data;
    }

    public function getTrackingPixelImage($subscriber)
    {
        $src = $this->getBrowserUrl($subscriber).'.png';
        return '<img src="'.$src.'" alt="" />';
    }

    //
    // Group management
    //

    public function getGroupsOptions()
    {
        $result = [];

        $apiResult = Event::fire('responsiv.campaign.listRecipientGroups');
        if (is_array($apiResult)) {
            foreach ($apiResult as $groupList) {
                if (!is_array($groupList)) {
                    continue;
                }

                foreach ($groupList as $code => $name) {
                    $result[$code] = $name;
                }
            }
        }

        return $result;
    }

    //
    // Page management
    //

    /**
     * Returns a list of pages available in the theme.
     * @return array Returns an array of strings.
     */
    public function getPageOptions()
    {
        $result = [];

        $pages = $this->listPagesWithCampaignComponent();
        foreach ($pages as $baseName => $page) {
            $result[$baseName] = strlen($page->name) ? $page->name : $baseName;
        }

        if (!$result) {
            $result[null] = 'No pages found';
        }

        return $result;
    }

    /**
     * Returns a collection of page objects that use the
     * Campaign Component provided by this plugin.
     * @return array
     */
    public function listPagesWithCampaignComponent()
    {
        $result = [];
        $pages = Page::withComponent('campaignTemplate')->sortBy('baseFileName')->all();

        foreach ($pages as $page) {
            $baseName = $page->getBaseFileName();
            $result[$baseName] = $page;
        }

        return $result;
    }

    public function getPageObject()
    {
        return Page::find($this->page);
    }

    public function getPageName()
    {
        return ($page = $this->getPageObject()) ? $page->title : $this->page;
    }

    protected function getPageContent($page)
    {
        $theme = Theme::getEditTheme();
        $result = CmsController::render($page, ['code' => LARAVEL_START], $theme);
        return $result;
    }

    public function renderTemplate()
    {
        if (!$this->content) return null;

        $parser = $this->getSyntaxParser($this->content);
        $data = $this->getSyntaxData();
        $template = $parser->render($data);
        return $template;
    }

    public function renderForSubscriber($subscriber)
    {
        $parser = new TextParser;
        $template = $this->renderTemplate();
        $data = $this->buildTagData($subscriber);
        $result = $parser->parseString($template, $data);

        // Inject tracking pixel
        $result = str_replace(
            '</body>',
            $this->getTrackingPixelImage($subscriber) . PHP_EOL . '</body>',
            $result
        );

        return $result;
    }

    //
    // Scopes
    //

    public function scopeIsArchived($query)
    {
        return $query->where('status_id', '!=', MessageStatus::getArchivedStatus()->id);
    }

}