<?php namespace Leancode\Campaign\Models;

use Backend\Models\ImportModel;
use ApplicationException;
use Request;
use Carbon\Carbon;
use DB;

/**
 * Subscriber Import Model
 */
class SubscriberImport extends ImportModel
{
    public $table = 'leancode_campaign_subscribers';

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
        if (!$results) {
            throw new ApplicationException('No import data received. Please check the format of the csv file and try again.');
        }

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
		$counter=1;

        foreach ($results as $row => $data) {
            try {

                if (!$email = array_get($data, 'email')) {
                    $this->logSkipped($row, 'Missing email address');
                    continue;
                }

                /*
                 * Find or create
                 */
                $subscriber = Subscriber::firstOrNew(['email' => $email]);
                $subscriberExists = $subscriber->exists;
                /*
                 * Set attributes
                 */
                $except = ['lists'];
                foreach (array_except($data, $except) as $attribute => $value) {
                	if(trim($value)) {
                		$subscriber->{$attribute} = $value;
					}                	
                	elseif(strpos(strtolower($attribute),"_at")!==false) {
                		$subscriber->{$attribute} = Carbon::now();//gmdate("Y-m-d H:i:s");
                	}
					elseif(strpos(strtolower($attribute),"ip_address")!==false){
						$subscriber->{$attribute} = Request::ip();
					}
					elseif(strpos(strtolower($attribute),"message_type")!==false){
						$subscriber->{$attribute} = "html";
					}
                    else {
                    	$subscriber->{$attribute} = null;
                    }
                }
                $subscriber->forceSave();
               if ($listIds = $this->getListIdsForSubscriber($data)) {
//				$sql =	"INSERT INTO leancode_campaign_lists_subscribers SET list_id = 1, subscriber_id=$subscriber->id ON DUPLICATE KEY UPDATE list_id=list_id";
//	    		DB::statement( DB::raw($sql) );
            	}

                /*
                 * Log results
                 */
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
            $listNames = $this->decodeArrayValue(array_get($data, 'lists'));

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