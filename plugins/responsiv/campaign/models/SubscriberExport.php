<?php namespace Responsiv\Campaign\Models;

use Backend\Models\ExportModel;
use ApplicationException;

/**
 * Subscriber Export Model
 */
class SubscriberExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        return Subscriber::get($columns);
    }
}