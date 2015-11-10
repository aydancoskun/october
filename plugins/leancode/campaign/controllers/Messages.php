<?php namespace Leancode\Campaign\Controllers;

use File;
use Flash;
use Request;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Leancode\Campaign\Models\Message;
use Leancode\Campaign\Models\Subscriber;
use Leancode\Campaign\Classes\CampaignManager;
use Exception;

/**
 * Messages Back-end Controller
 */
class Messages extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = ['leancode.campaign.manage_messages'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Leancode.Campaign', 'campaign', 'messages');
    }

    /**
     * Add dynamic syntax fields
     */
    public function formExtendFields($host)
    {
        if (!in_array($host->getContext(), ['update', 'setup'])) {
            return;
        }

        $fields = $host->model->getFormSyntaxFields();
        if (!is_array($fields)) {
            return;
        }

        $host->addFields($fields);
    }

    //
    // Create
    //

    public function index_onCreateForm()
    {
        $model = $this->formCreateModelObject();
        $options = $model->getPageOptions();
        if (!key($options)) {
            return $this->makePartial('setup_form');
        }

        $this->asExtension('FormController')->create();
        return $this->makePartial('create_form');
    }

    public function index_onArchive()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $messageId) {
                if (!$message = Message::find($messageId)) continue;
                CampaignManager::instance()->archiveCampaign($message);
            }

            Flash::success('Successfully archived these mailings');
        }
        else {
            Flash::error('There are no mailings selected to archive.');
        }

        return $this->listRefresh();
    }

    public function index_onCreate()
    {
        return $this->asExtension('FormController')->create_onSave();
    }

    public function index_onGenerateTemplate()
    {
        $templatePath = __DIR__ . '/../partials/default_page_content.htm';

        try {
            $pages = Page::lists('baseFileName', 'baseFileName');
            $pageName = post('page_name');
            $pageSettings = [
                'title'                    => post('page_title'),
                'url'                      => post('page_url'),
                'description'              => post('page_description'),
                'leancodeCampaignTemplate' => []
            ];

            $pageExists = array_key_exists($pageName, $pages);
            if (!$pageExists) {
                $this->createPageFromFile($templatePath, $pageName, $pageSettings, Theme::getEditTheme());
            }
        }
        catch (Exception $ex) {
            $this->handleError($ex);
        }

        return $this->index_onCreateForm();
    }

    //
    // Duplicate
    //

    public function preview_onDuplicateForm($recordId = null)
    {
        $source = $this->formFindModelObject($recordId);
        $model = $this->formCreateModelObject();
        $model->name = $source->name;

        $this->vars['formSourceId'] = $source->id;

        $this->initForm($model, 'duplicate');
        return $this->makePartial('duplicate_form');
    }

    public function preview_onDuplicate()
    {
        $source = $this->formFindModelObject(post('source_id'));

        $model = $source->duplicateCampaign();
        $model->name = post('Message[name]');
        $model->save();

        Flash::success('Duplicated this mailing successfully!');

        if ($redirect = $this->makeRedirect('update-close', $model)) {
            return $redirect;
        }
    }

    //
    // Updating and Sending
    //

    public function update($recordId = null, $context = null)
    {
        if ($context == 'send')
            $this->pageTitle = 'Send campaign message';

        $this->bodyClass = 'compact-container';

        $this->vars['availableTags'] = Message::getAvailableTags();

        return $this->asExtension('FormController')->update($recordId, $context);
    }

    public function preview($recordId = null, $context = null)
    {
        $this->bodyClass = 'slim-container';
        return $this->asExtension('FormController')->preview($recordId, $context);
    }

    public function preview_onTest($recordId = null)
    {
        try {
            $model = $this->formFindModelObject($recordId);
            $user = $this->user;

            /*
             * Subscribe the tester
             */
            $subscriber = Subscriber::signup([
                'email'      => $user->email,
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name,
            ]);

            CampaignManager::instance()->sendToSubscriber($model, $subscriber);

            Flash::success('The test mailing was successfully sent.');
        }
        catch (Exception $ex) {
            Flash::error($ex->getMessage());
        }
    }

    public function preview_onDelete($recordId = null)
    {
        return $this->asExtension('FormController')->update_onDelete($recordId);
    }

    public function preview_onCancel($recordId = null)
    {
        if ($recordId && ($model = $this->formFindModelObject($recordId))) {
            CampaignManager::instance()->cancelCampaign($model);
        }

        return Redirect::refresh();
    }

    public function preview_onArchive($recordId = null)
    {
        if ($recordId && ($model = $this->formFindModelObject($recordId))) {
            CampaignManager::instance()->archiveCampaign($model);
        }

        return Redirect::refresh();
    }

    public function preview_onRecreate($recordId = null)
    {
        if ($recordId && ($model = $this->formFindModelObject($recordId))) {
            CampaignManager::instance()->recreateCampaign($model);
        }

        return Redirect::refresh();
    }

    public function onSend($recordId = null, $context = null)
    {
        $result = $this->asExtension('FormController')->update_onSave($recordId, $context);

        if ($model = $this->formGetModel()) {
            CampaignManager::instance()->confirmReady($model);
        }

        return $result;
    }

    public function onRefreshTemplate($recordId = null)
    {
        if ($recordId && ($model = $this->formFindModelObject($recordId))) {
            $model->rebuildContent();
            $model->save();
        }

        return Redirect::refresh();
    }

    //
    // Helpers
    //

    /**
     * Creates a page using the contents of a specified file.
     * @param  string $filePath  File containing page contents
     * @param  string $name      New Page name
     * @param  string $settings  Page settings
     * @param  string $themeCode Theme to create the page
     * @return void
     */
    protected function createPageFromFile($filePath, $name, $settings, $themeCode)
    {
        if (!File::exists($filePath))
            return false;

        $page = new Page($themeCode);
        $page->fill([
            'fileName' => $name,
            'markup'   => File::get($filePath),
            'settings' => $settings
        ]);
        $page->save();
        return true;
    }

}
