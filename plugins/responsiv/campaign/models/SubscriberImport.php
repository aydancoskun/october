<?php namespace Responsiv\Campaign\Models;

use Backend\Models\ImportModel;
use ApplicationException;

/**
 * Subscriber Import Model
 */
class SubscriberImport extends ImportModel
{
    public $table = 'responsiv_campaign_subscribers';

    /**
     * Validation rules
     */
    public $rules = [
        'email' => 'required|email',
    ];

    protected $listNameCache = [];

    public function getSubscriberListsOptions()
    {
        return SubscriberList::lists('name', 'id');
    }

    public function importData($results, $sessionKey = null)
    {
        $firstRow = reset($results);

        /*
         * Validation
         */
        if ($this->auto_create_lists && !array_key_exists('lists', $firstRow)) {
            throw new ApplicationException('Please specify a match for the Lists column.');
        }

        /*
         * Import
         */
        foreach ($results as $row => $data) {
            try {

                if (!$email = array_get($data, 'email')) {
                    $this->logSkipped($row, 'Missing email address');
                    continue;
                }

                $subscriber = Subscriber::firstOrNew(['email' => $email]);
                $subscriberExists = $subscriber->exists;

                foreach ($data as $attribute => $value) {
                    $subscriber->{$attribute} = $value;
                }

                $subscriber->forceSave();

                if ($listIds = $this->getListIdsForSubscriber($data)) {
                    $subscriber->subscriber_lists()->sync($listIds, false);
                }

                if ($subscriberExists) {
                    $this->logUpdated();
                }
                else {
                    $this->logCreated();
                }
            }
            catch (Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }

    }

    protected function getListIdsForSubscriber($data)
    {
        $ids = [];

        if ($this->auto_create_lists) {
            $listNames = explode('|', array_get($data, 'lists'));

            foreach ($listNames as $name) {
                if (!$name = trim($name)) continue;

                if (isset($this->listNameCache[$name])) {
                    $ids[] = $this->listNameCache[$name];
                }
                else {
                    $newList = SubscriberList::firstOrCreate(['name' => $name]);
                    $ids[] = $this->listNameCache[$name] = $newList->id;
                }
            }
        }
        elseif ($this->subscriber_lists) {
            $ids = (array) $this->subscriber_lists;
        }

        return $ids;
    }

}