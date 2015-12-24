<?php namespace Leancode\Campaign\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Leancode\Campaign\Classes\CampaignWorker;
use DB;

class CampaignTest extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'addresso:test';

    /**
     * @var string The console command description.
     */
    protected $description = 'Perform campaign testing.';

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

    	$num = DB::table('leancode_campaign_lists_subscribers')->where('subscriber_id',2)->update(['list_id'=>60]);
   		$this->output->writeln("Updating Dom and moving him back into his category... ($num)");

    	$num = DB::table('leancode_campaign_lists_subscribers')->where('subscriber_id',10)->update(['list_id'=>70]);
   		$this->output->writeln("Updating Clive and moving him back into his category... ($num)");

    	$dbr = DB::table('leancode_campaign_subscribers')
    	            ->select('id')
    	            ->whereNotNull('unsubscribed_at')
//    	            ->whereNotNull('blacklisted_at')
                    ->leftJoin('leancode_campaign_lists_subscribers','id','=','subscriber_id')
    	            ->where('list_id','<>','90')
    	            ->get();
		$this->output->writeln("Moving unsubscribed to list 90... (".count($dbr).")");
        foreach($dbr as $row){
            DB::table('leancode_campaign_lists_subscribers')
        	    ->where('subscriber_id',$row->id)
        	    ->update(['list_id'=>90]);
        }

    	$dbr = DB::table('leancode_campaign_subscribers')
    	            ->select('id')
//    	            ->whereNotNull('unsubscribed_at')
    	            ->whereNotNull('blacklisted_at')
                    ->leftJoin('leancode_campaign_lists_subscribers','id','=','subscriber_id')
    	            ->where('list_id','<>','100')
    	            ->get();
		$this->output->writeln("Moving blacklisted to list 100... (".count($dbr).")");
        foreach($dbr as $row){
        	DB::table('leancode_campaign_lists_subscribers')
        	    ->where('subscriber_id',$row->id)
        	    ->update(['list_id'=>100]);
        }

		// L / blacklisted - unsubscribed / iu_company
    	$dbr = DB::table('operations.users')->select('id')->whereNotNull('ok_unsubscribed_at')->whereNotNull('ok_blacklisted_at')->where('L','<>','X')->get();
		$this->output->writeln("Making sure all blacklisted & unsubscribed are marked only in 'L' column... (".count($dbr).")");
        foreach($dbr as $row){
        	DB::table('operations.users')
        	    ->where('id',$row->id)
        	    ->update(['A'=>null,'B'=>null,'C'=>null,'D'=>null,'E'=>null,'F'=>null,'G'=>null,'H'=>null,'I'=>null,'J'=>null,'K'=>null,'L'=>'X']);
        }


//		$this->output->writeln("Reset subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 99 WHERE ".
				"( cls.list_id BETWEEN 1 AND 7 )";
//    	DB::statement( DB::raw($sql) );


		// A / Mailed to / iu_gender
    	$num = DB::table('operations.users')->whereNull('L')->where('is_activated',1)->update(['A'=>'Y']);

    	$dbr = DB::table('operations.users')
    	            ->select('id')
    	            ->whereNotNull('L')
                    ->leftJoin('leancode_campaign_messages_subscribers','id','=','subscriber_id')
    	            ->whereNotNull('sent_at')
    	            ->where('A','<>','Y')
    	            ->get();
		$this->output->writeln("Updating those we've mailed to... ($num+".count($dbr).")");
        foreach($dbr as $row){
            DB::table('leancode_campaign_lists_subscribers')
        	    ->where('subscriber_id',$row->id)
        	    ->update(['A'=>'Y']);
        }


		// B / pingback / iu_job
    	$dbr = DB::table('operations.users')
    	            ->select('id')
    	            ->whereNotNull('A')
                    ->leftJoin('leancode_campaign_messages_subscribers','id','=','subscriber_id')
    	            ->whereNotNull('read_at')
    	            ->where('B','<>','Y')
    	            ->get();
		$this->output->writeln("Updating those we've received pingback from... (".count($dbr).")");
        foreach($dbr as $row){
            DB::table('leancode_campaign_lists_subscribers')
        	    ->where('subscriber_id',$row->id)
        	    ->update(['B'=>'Y']);
        }

exit;















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
    	$count = DB::table('operations.users')->whereNotNull('A')->count();
		$this->output->writeln("Checking how many should be there now... $count");
    	$count = DB::table('leancode_campaign_lists_subscribers')->where('list_id',1)->count();
		$this->output->writeln("Checking how are there now... $count");

		// 2 = D
		$this->output->writeln("Updating 'Clicked but NOT accepted the FCFL' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 2 WHERE ".
//				"cls.list_id = 1 AND ".
				"u.D IS NOT NULL";
    	DB::statement( DB::raw($sql) );
    	$count = DB::table('operations.users')->whereNotNull('D')->count();
		$this->output->writeln("Checking how many should be there now... $count");
    	$count = DB::table('leancode_campaign_lists_subscribers')->where('list_id',2)->count();
		$this->output->writeln("Checking how are there now... $count");

		// 3 = F
		$this->output->writeln("Updating 'Accepted FCFL but currently NOT applying credits' in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 3 WHERE ".
//				"( cls.list_id BETWEEN 1 AND 7 ) AND ".
				"u.F IS NOT NULL";
    	DB::statement( DB::raw($sql) );
    	$count = DB::table('operations.users')->whereNotNull('F')->count();
		$this->output->writeln("Checking how many should be there now... $count");
    	$count = DB::table('leancode_campaign_lists_subscribers')->where('list_id',3)->count();
		$this->output->writeln("Checking how are there now... $count");

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


















        $message = CampaignWorker::instance()->process(true);
        $this->output->writeln($message);
    }

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
