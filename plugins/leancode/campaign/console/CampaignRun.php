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

		// L / blacklisted - unsubscribed / iu_company
		$this->output->writeln("Updating mailing categories in users... ");
		$this->output->writeln("Updating blacklisted / unsubscribed step 1... ");
		$sql =  "UPDATE operations.users SET L = 'X', A = NULL, B = NULL, C = NULL, D = NULL, E = NULL, F = NULL, G = NULL, H = NULL, I = NULL, J = NULL, K = NULL WHERE ".
				"ok_unsubscribed_at IS NOT NULL OR ".
				"ok_blacklisted_at IS NOT NULL OR ".
				"ok_unsubscribed_at <> '' OR ".
				"ok_blacklisted_at <> ''";
				//echo $sql ."\n";
    	DB::statement( DB::raw($sql) );

		// This inserts into the subscriber table those that have unsubscribed from the emails.
		$this->output->writeln("Updating blacklisted / unsubscribed step 2... ");
	    $sql =	"INSERT into leancode_campaign_lists_subscribers ".
	    		"(select 90, id from leancode_campaign_subscribers where unsubscribed_at is not NULL) ".
	    		"ON DUPLICATE KEY UPDATE leancode_campaign_lists_subscribers.list_id = leancode_campaign_lists_subscribers.list_id";
				DB::statement( DB::raw($sql) );

		// This deletes those that have unsubscribed from any other list
		$this->output->writeln("Updating blacklisted / unsubscribed step 3... ");
	    $sql =	"DELETE one FROM leancode_campaign_lists_subscribers one WHERE EXISTS ".
	    		"( SELECT 1 FROM leancode_campaign_subscribers two WHERE one.subscriber_id = two.id AND one.list_id <> 90 AND two.unsubscribed_at is not null )";
				DB::statement( DB::raw($sql) );

		// This inserts into the subscriber table those that have arrived in the mail box as undeliverable.
		$this->output->writeln("Updating blacklisted / unsubscribed step 4... ");
	    $sql =	"INSERT into leancode_campaign_lists_subscribers ".
	    		"(select 100, id from leancode_campaign_subscribers where blacklisted_at is not NULL) ".
	    		"ON DUPLICATE KEY UPDATE leancode_campaign_lists_subscribers.list_id = leancode_campaign_lists_subscribers.list_id";
				DB::statement( DB::raw($sql) );

		// This deletes those that are blacklisted from any other list other than unsubscribed and blacklisted
		$this->output->writeln("Updating blacklisted / unsubscribed step 5... ");
		$sql =	"DELETE one FROM leancode_campaign_lists_subscribers one WHERE EXISTS ".
				"( SELECT 1 FROM leancode_campaign_failed_deliveries two WHERE one.subscriber_id = two.id AND one.list_id <> 90 AND one.list_id <> 100)";
				DB::statement( DB::raw($sql) );



//		$this->output->writeln("Reset subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 99 WHERE ".
				"( cls.list_id BETWEEN 1 AND 7 )";
//    	DB::statement( DB::raw($sql) );


		// A / Mailed to / iu_gender
		$this->output->writeln("Updating mailed to step 1... ");
		$sql =  "UPDATE operations.users u ".
				"SET A = 'Y' WHERE ".
				"L IS NULL AND ". 
				"is_activated = 1 ";
    	DB::statement( DB::raw($sql) );

		$this->output->writeln("Updating mailed to step 2... ");
		$sql =  "UPDATE operations.users u LEFT JOIN oktick.leancode_campaign_messages_subscribers cms ON u.id = cms.subscriber_id ".
				"SET u.A = 'Y' WHERE ".
				"L IS NULL AND ". 
				"( cms.sent_at <> '' AND cms.sent_at IS NOT NULL )";
    	DB::statement( DB::raw($sql) );


		// B / pingback / iu_job
		$this->output->writeln("Update pingback... ");
		$sql =  "UPDATE operations.users u LEFT JOIN oktick.leancode_campaign_messages_subscribers cms ON u.id = cms.subscriber_id ".
				"SET B = 'Y' WHERE ".
				"A IS NOT NULL AND ".
				"( cms.read_at <> '' OR cms.read_at IS NOT NULL ) ";
    	DB::statement( DB::raw($sql) );


		// C / activated / iu_about
		$this->output->writeln("Update 'clicked on the mail' and thereby activated... ");
		$sql =  "UPDATE operations.users ".
				"SET C = 'Y' WHERE ".
				"A IS NOT NULL AND ".
				"L IS NULL AND ".
				"is_activated = 1 ";
    	DB::statement( DB::raw($sql) );


		// D / activated but no FCFL / iu_webpage
		$this->output->writeln("Clicked mail (activated) but NOT accepted the FCFL offer... ");
		$sql =  "UPDATE operations.users ".
				"SET D='N', E = NULL WHERE ".
				"C IS NOT NULL AND ".
				"ok_free_credits_datetime = '0000-00-00 00:00:00' ";
    	DB::statement( DB::raw($sql) );


		// E / activated & FCFL / iu_blog
		$this->output->writeln("Clicked mail (activated) and accepted the FCFL offer... ");
		$sql =  "UPDATE operations.users ".
				"SET E = 'Y', D = NULL WHERE ".
				"C IS NOT NULL AND ".
				"L IS NULL AND ".
				"ok_free_credits_datetime <> '0000-00-00 00:00:00' ";
    	DB::statement( DB::raw($sql) );


		// F / FCFL but NOT using credits / iu_facebook
		$this->output->writeln("Accepted FCFL but currently NOT applying credits... ");
		$sql =  "UPDATE operations.users u LEFT JOIN operations.bp_sponsors bs ON u.id = bs.user_id ".
				"SET F ='N', G = NULL, H = NULL, I = NULL  WHERE ".
				"L IS NULL AND ".
				"E IS NOT NULL AND ".
				"bs.user_id IS NULL";
    	DB::statement( DB::raw($sql) );


		// G / FCFL but NOT using credits / iu_twitter
		$this->output->writeln("Accepted FCFL and applying credits (G=Y)... ");
		$sql =  "UPDATE operations.users u LEFT JOIN operations.bp_sponsors bs ON u.id = bs.user_id ".
				"SET G ='Y', F = NULL WHERE ".
				"L IS NULL AND ".
				"E IS NOT NULL AND ".
				"bs.user_id IS NOT NULL";
    	DB::statement( DB::raw($sql) );


		// H / FCFL but NOT max / iu_skype
		$this->output->writeln("Applying credits but NOT to the max - more than half left on account yet he renewed in last 7 days... ");
		$date = date("Y-m-d H:i:s", strtotime("- 7 days") );
		$sql =  "UPDATE operations.users ".
				"SET H ='N', I = NULL WHERE ".
				"L IS NULL AND ".
				"G IS NOT NULL AND ".
				"ok_credits >= 25 AND ".
				"ok_free_credits_datetime > '$date' ";
    	DB::statement( DB::raw($sql) );


		// I / FCFL to the MAX - Perfect! / iu_icq
		$this->output->writeln("Applying credits to the max - using more than half and renewing in last 7 days (I=Y)...");
		$date = date("Y-m-d H:i:s", strtotime("- 7 days") );
		$sql =  "UPDATE operations.users ".
				"SET I ='Y', H = NULL WHERE ".
				"L IS NULL AND ".
				"G IS NOT NULL AND ".
				"ok_credits < 25 AND ".
				"ok_free_credits_datetime > '$date' ";
    	DB::statement( DB::raw($sql) );


		// J / Credits but not updated / iu_comment
		$this->output->writeln("Having credits left but not renewing them  in last 7 days... ");
		$date = date("Y-m-d H:i:s", strtotime("- 7 days") );
		$sql =  "UPDATE operations.users ".
				"SET J ='N', H = NULL, I = NULL WHERE ".
				"L IS NULL AND ".
				"E IS NOT NULL AND ".
				"ok_credits >= 1 AND ok_credits < 50 AND ".
				"ok_free_credits_datetime < '$date' ";
    	DB::statement( DB::raw($sql) );


		// K / Credits but not updated / iu_telephone
		$this->output->writeln("Currently not having any credits left and not renewing them... ");
		$date = date("Y-m-d H:i:s", strtotime("- 7 days") );
		$sql =  "UPDATE operations.users ".
				"SET K ='N', J = NULL, H = NULL, I = NULL WHERE ".
				"L IS NULL AND ".
				"E IS NOT NULL AND ".
				"ok_credits < 1 AND ".
				"ok_free_credits_datetime < '$date' ";
    	DB::statement( DB::raw($sql) );



		// 1 = A
		$this->output->writeln("Updating mailed to in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 1 WHERE ".
//				"cls.list_id = 99 AND ".
				"u.A IS NOT NULL";
    	DB::statement( DB::raw($sql) );

		// 2 = D
		$this->output->writeln("Updating 'Clicked but NOT accepted the FCFL' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 2 WHERE ".
//				"cls.list_id = 1 AND ".
				"u.D IS NOT NULL";
    	DB::statement( DB::raw($sql) );

		// 3 = F
		$this->output->writeln("Updating 'Accepted FCFL but currently NOT applying credits' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 3 WHERE ".
//				"( cls.list_id BETWEEN 1 AND 7 ) AND ".
				"u.F IS NOT NULL";
    	DB::statement( DB::raw($sql) );

		// 4 = H
		$this->output->writeln("Updating 'Applying credits but NOT to the max' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 4 WHERE ".
//				"( cls.list_id BETWEEN 1 AND 7 ) AND ".
				"u.H IS NOT NULL";
    	DB::statement( DB::raw($sql) );

		// 5 = J
		$this->output->writeln("Updating 'Having credits left but not renewing them in last 7 days' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 5 WHERE ".
//				"( cls.list_id BETWEEN 1 AND 7 ) AND ".
				"u.J IS NOT NULL";
    	DB::statement( DB::raw($sql) );

		// 6 = K
		$this->output->writeln("Updating 'Having credits left but not renewing them  in last 7 days' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 6 WHERE ".
//				"( cls.list_id BETWEEN 1 AND 7 ) AND ".
				"u.K IS NOT NULL";
    	DB::statement( DB::raw($sql) );

		// 7 = I
		$this->output->writeln("Updating 'Applying credits to the max' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 7 WHERE ".
//				"( cls.list_id BETWEEN 1 AND 7 ) AND ".
				"u.I IS NOT NULL";
    	DB::statement( DB::raw($sql) );


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
//			$sql =	"UPDATE leancode_campaign_lists_subscribers a, users b SET list_id = 4 WHERE a.subscriber_id = b.id AND list_id = 3 AND b.ok_free_credits_datetime <> '0000-00-00 00:00:00'";
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