<?php namespace Responsiv\Campaign\Models;

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
    public $table = 'responsiv_campaign_lists';

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
        'subscribers' => ['Responsiv\Campaign\Models\Subscriber', 'table' => 'responsiv_campaign_lists_subscribers', 'key' => 'list_id'],
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