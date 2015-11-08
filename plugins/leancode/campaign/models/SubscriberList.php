<?php namespace Leancode\Campaign\Models;

use Model;
use Carbon\Carbon;

/**
 * List Model
 */
class SubscriberList extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'leancode_campaign_lists';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'subscribers' => ['Leancode\Campaign\Models\Subscriber', 'table' => 'leancode_campaign_lists_subscribers', 'key' => 'list_id'],
        'subscribers_count' => ['Leancode\Campaign\Models\Subscriber', 'table' => 'leancode_campaign_lists_subscribers', 'key' => 'list_id', 'count' => true],
    ];

    public function getCountSubscribersAttribute()
    {
        return $this->subscribers()->count();
    }

    public function getCountSubscribersTodayAttribute()
    {
        $yesterday = Carbon::now()->addDays(-1)->toDateTimeString();
        return $this->subscribers()->where('created_at', '>', $yesterday)->count();
    }

}