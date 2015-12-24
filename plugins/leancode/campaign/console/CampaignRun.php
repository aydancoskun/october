<?php namespace Leancode\Campaign\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Leancode\Campaign\Classes\CampaignWorker;
use DB;

class CampaignRun extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'addresso:run';

    /**
     * @var string The console command description.
     */
    protected $description = 'Perform campaign processing.';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {



        $message = CampaignWorker::instance()->process();
        $this->output->writeln($message);
    }



			// step 1
//			$sql =	"UPDATE leancode_campaign_lists_subscribers a, leancode_campaign_messages_subscribers b SET list_id = 2 WHERE a.subscriber_id = b.subscriber_id AND list_id = 1 AND b.sent_at <> ''";
//	    	DB::statement( DB::raw($sql) );

			// step 2
//			$sql =	"UPDATE leancode_campaign_lists_subscribers a, users b SET list_id = 3 WHERE a.subscriber_id = b.id AND list_id = 2 AND b.is_activated = 1";
//	    	DB::statement( DB::raw($sql) );

			// step 3
//			$sql =	"UPDATE leancode_campaign_lists_subscribers a, users b SET list_id = 4 WHERE a.subscriber_id = b.id AND list_id = 3 AND b.ok_free_credits_datetime IS NOT NULL";
//	    	DB::statement( DB::raw($sql) );

			// step 3
//			$sql =	"UPDATE leancode_campaign_lists_subscribers a, operations.bp_sponsors b SET list_id = 5 WHERE a.subscriber_id = b.user_id AND list_id = 4";
//	    	DB::statement( DB::raw($sql) );









    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}
