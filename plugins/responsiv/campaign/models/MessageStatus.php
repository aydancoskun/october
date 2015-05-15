<?php namespace Responsiv\Campaign\Models;

use Model;

/**
 * MessageStatus Model
 */
class MessageStatus extends Model
{

    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_SENT = 'sent';
    const STATUS_DELETED = 'cancelled';
    const STATUS_ARCHIVED = 'archived';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'responsiv_campaign_message_statuses';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var Collection Cache of all records
     */
    public static $recordCache;

    public static function getDraftStatus()
    {
        return self::getFromCode(self::STATUS_DRAFT);
    }

    public static function getPendingStatus()
    {
        return self::getFromCode(self::STATUS_PENDING);
    }

    public static function getActiveStatus()
    {
        return self::getFromCode(self::STATUS_ACTIVE);
    }

    public static function getSentStatus()
    {
        return self::getFromCode(self::STATUS_SENT);
    }

    public static function getCancelledStatus()
    {
        return self::getFromCode(self::STATUS_DELETED);
    }

    public static function getArchivedStatus()
    {
        return self::getFromCode(self::STATUS_ARCHIVED);
    }

    public static function getFromCode($code)
    {
        return self::listAll()->first(function($key, $status) use ($code) {
            return $status->code == $code;
        });
    }

    public static function listAll()
    {
        if (self::$recordCache !== null) {
            return self::$recordCache;
        }

        return self::$recordCache = self::all();
    }

    /**
     * Returning the code is more useful than returning JSON.
     */
    public function __toString()
    {
        return $this->code;
    }

}