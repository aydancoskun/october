<?php namespace Leancode\Campaign\Models;

use Backend\Models\ExportModel;
use ApplicationException;

/**
 * Subscriber Export Model
 */
class SubscriberExport extends ExportModel
{
    public $table = 'leancode_campaign_subscribers';

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'subscriber_lists' => [
            'Leancode\Campaign\Models\SubscriberList',
            'table' => 'leancode_campaign_lists_subscribers',
            'key' => 'subscriber_id',
            'otherKey' => 'list_id'
        ],
    ];

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = [
        'lists'
    ];

    public function exportData($columns, $sessionKey = null)
    {
        $result = self::make()
            ->with([
                'subscriber_lists'
            ])
            ->get()
            ->toArray()
        ;

        return $result;
    }

    public function getListsAttribute()
    {
        if (!$this->subscriber_lists) return '';
        return $this->encodeArrayValue($this->subscriber_lists->lists('name'));
    }
}