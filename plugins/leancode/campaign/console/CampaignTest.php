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
        define('MAIL_STARTED',time());
        $arguments = $this->getArguments("skip");
		// L / blacklisted - unsubscribed / iu_company
    	$dbr = DB::table('operations.users')->select('id')->whereNotNull('ok_unsubscribed_at')->whereNotNull('ok_blacklisted_at')->whereNull('L')->get();
		$this->output->writeln("Making sure all blacklisted & unsubscribed are marked only in 'L' column... (".count($dbr).")");
        foreach($dbr as $row){
        	DB::table('operations.users')
        	    ->where('id',$row->id)
        	    ->update(['A'=>null,'B'=>null,'C'=>null,'D'=>null,'E'=>null,'F'=>null,'G'=>null,'H'=>null,'I'=>null,'J'=>null,'K'=>null,'L'=>'X']);
        }

/*
        $num = DB::table('leancode_campaign_lists_subscribers')->whereBetween('list_id', array(1, 7))->update(['list_id'=>99]);
		$this->output->writeln("Reset subscriber table... (".count($num).")");
        $num = DB::table('operations.users')
                    ->update(['A'=>null,'B'=>null,'C'=>null,'D'=>null,'E'=>null,'F'=>null,'G'=>null,'H'=>null,'I'=>null,'J'=>null,'K'=>null,'L'=>null]);
		$this->output->writeln("Reset user table A-L table... (".count($num).")");
*/

        // reseting any special list items in A
        DB::table('operations.users')->where('mailing_list_id','<>',140)->where('A','S')->update(['A'=>null]);

		// A / Mailed to / iu_gender
    	$num = DB::table('operations.users')->whereNull('L')->where('is_activated',1)->update(['A'=>'Y','C'=>'Y']);
    	$total = DB::table('operations.users')
    	            ->select('id')
    	            ->whereNull('L')
    	            ->whereNull('A')
                    ->leftJoin('leancode_campaign_messages_subscribers','id','=','subscriber_id')
    	            ->whereNotNull('sent_at')
    	            ->distinct()
    	            ->count();
        for( $c=0 ; $c < $total ; $c=$c+1000 ) {
    	    $dbr = DB::table('operations.users')
    	            ->select('id')
    	            ->whereNull('L')
    	            ->whereNull('A')
    	            ->where('mailing_list_id','<>',60)
    	            ->where('mailing_list_id','<>',70)
    	            ->where('mailing_list_id','<>',90)
    	            ->where('mailing_list_id','<>',100)
    	            ->where('mailing_list_id','<>',110)
    	            ->where('mailing_list_id','<>',120)
    	            ->where('mailing_list_id','<>',140)
    	            ->where('mailing_list_id','<>',150)
                    ->leftJoin('leancode_campaign_messages_subscribers','id','=','subscriber_id')
    	            ->whereNotNull('sent_at')
//    	            ->toSql();
//            		$this->output->writeln($dbr);
//            		exit;
    	            ->skip($c)
    	            ->take(1000)
    	            ->distinct()
    	            ->get();
	        $this->output->writeln("Updating those we've mailed to... (".($c)." of $total)");
            foreach($dbr as $row){
                DB::table('operations.users')
        	        ->where('id',$row->id)
        	        ->update(['A'=>'Y']);
            }
        }

		// B / pingback / iu_job
    	$dbr = DB::table('operations.users')
    	            ->select('id')
    	            ->where('A','Y')
                    ->leftJoin('leancode_campaign_messages_subscribers','id','=','subscriber_id')
    	            ->whereNotNull('read_at')
    	            ->whereNull('B')
    	            ->get();
		$this->output->writeln("Updating those we've received pingback from... (".count($dbr).")");
        foreach($dbr as $row){
            DB::table('operations.users')
        	    ->where('id',$row->id)
        	    ->update(['B'=>'Y']);
        }


		// C / activated / iu_about
		//done in A above
		$this->output->writeln("Updating those who clicked the email and therefore activated... ($num)");
    	$num = DB::table('operations.users')->whereNotNull('A')->whereNull('C')->where('is_activated',1)->update(['C'=>'Y']);


		// D / activated but no FCFL / iu_webpage
    	$num = DB::table('operations.users')->whereNotNull('C')->whereNull('ok_free_credits_datetime')->update(['D'=>'N','E'=>null]);
		$this->output->writeln("Updating those who activated but did not take the offer... ($num)");


		// E / activated & FCFL / iu_blog
    	$num = DB::table('operations.users')->whereNotNull('C')->whereNotNull('ok_free_credits_datetime')->update(['D'=>null,'E'=>'Y']);
		$this->output->writeln("Updating those who activated and took the offer... ($num)");


		// F / FCFL but NOT using credits / iu_facebook
    	$dbr = DB::table('operations.users')
    	            ->select('users.id')
    	            ->whereNotNull('E')
                    ->leftJoin('operations.bp_sponsors','users.id','=','user_id')
    	            ->whereNull('user_id')
    	            ->whereNull('F')
    	            ->get();
		$this->output->writeln("Updating those who are not applying credits... (".count($dbr).")");
        foreach($dbr as $row){
            DB::table('operations.users')
        	    ->where('id',$row->id)
        	    ->update(['F'=>'N', 'G'=>null, 'H'=>null,'I'=>null]);
        }


		// G / FCFL but NOT using credits / iu_twitter
    	$dbr = DB::table('operations.users')
    	            ->select('users.id')
    	            ->whereNotNull('E')
                    ->leftJoin('operations.bp_sponsors','users.id','=','user_id')
    	            ->whereNotNull('user_id')
    	            ->whereNull('G')
    	            ->get();
		$this->output->writeln("Updating those who ARE currently applying credits... (".count($dbr).")");
        foreach($dbr as $row){
            DB::table('operations.users')
        	    ->where('id',$row->id)
        	    ->update(['G'=>'Y', 'F'=>null]);
        }


		// H / FCFL but NOT max / iu_skype
        $date = date("Y-m-d H:i:s", strtotime("- 7 days"));
    	$num = DB::table('operations.users')->whereNotNull('G')->where('ok_credits','>=',25)->where('ok_free_credits_datetime','>',$date)->update(['H'=>'N','I'=>null]);
		$this->output->writeln("Applying credits but NOT to the max - more than half left on account yet he renewed in last 7 days... ($num)");


		// I / FCFL to the MAX - Perfect! / iu_icq
    	$num = DB::table('operations.users')->whereNotNull('G')->where('ok_credits','<',25)->where('ok_free_credits_datetime','>',$date)->update(['I'=>'Y','H'=>null]);
		$this->output->writeln("Applying credits to the max - using more than half and renewing in last 7 days... ($num)");


		// J / Credits but not updated / iu_comment
    	$num = DB::table('operations.users')->whereNotNull('E')->where('ok_credits','>=',1)->where('ok_credits','<',50)->where('ok_free_credits_datetime','<',$date)->update(['J'=>'N','H'=>null,'I'=>null]);
		$this->output->writeln("Having credits left and not renewing in last 7 days... ($num)");


		// K / Credits but not updated / iu_telephone
    	$num = DB::table('operations.users')->whereNotNull('E')->where('ok_credits','<',1)->where('ok_free_credits_datetime','<',$date)->update(['K'=>'N','J'=>null,'H'=>null,'I'=>null]);
		$this->output->writeln("Currently not having any credits left and not renewing them... ($num)");


		// 1 = A
		$total = DB::table('operations.users')->where('A','Y')->update(['mailing_list_id'=>1]);
	    $this->output->writeln("Updating mailed to in subscriber table... ($total)");

		// 2 = D
		$total = DB::table('operations.users')->whereNotNull('D')->update(['mailing_list_id'=>2]);
		$this->output->writeln("Updating 'Clicked but NOT accepted the FCFL' in subscriber table... ($total)");

		// 3 = F
		$total = DB::table('operations.users')->whereNotNull('F')->update(['mailing_list_id'=>3]);
		$this->output->writeln("Updating 'Accepted FCFL but currently NOT applying credits' in subscriber table... ($total)");

		// 4 = H
		$total = DB::table('operations.users')->whereNotNull('H')->update(['mailing_list_id'=>4]);
		$this->output->writeln("Updating 'Applying credits but NOT to the max' in subscriber table... ($total)");

		// 5 = J
		$total = DB::table('operations.users')->whereNotNull('J')->update(['mailing_list_id'=>5]);
		$this->output->writeln("Updating 'Having credits left but not renewing them in last 7 days' in subscriber table... ($total)");

		// 6 = K
		$total = DB::table('operations.users')->whereNotNull('K')->update(['mailing_list_id'=>6]);
		$this->output->writeln("Updating 'Having no credits left and not renewing them  in last 7 days' in subscriber table... ($total)");

		// 7 = I
		$total = DB::table('operations.users')->whereNotNull('I')->update(['mailing_list_id'=>7]);
		$this->output->writeln("Updating 'Applying credits to the max' in subscriber table... ($total)");

        // now enough products
		$total = DB::table('operations.users')->where('ok_company_products_count','>',1)->where('mailing_list_id',130)->update(['mailing_list_id'=>99]);
		$this->output->writeln("Updating 'not enough products' in subscriber table... ($total)");

        // not enough products
		$total = DB::table('operations.users')->where('ok_company_products_count','<',2)->update(['mailing_list_id'=>130]);
		$this->output->writeln("Updating 'not enough products' in subscriber table... ($total)");

        // no company
		$total = DB::table('operations.users')->wherenull('ok_company_id')->update(['mailing_list_id'=>120]);
		$this->output->writeln("Updating 'no company' in subscriber table... ($total)");

		DB::table('operations.users')->where('id',2)->update(['mailing_list_id'=>60]);
   		$this->output->writeln("Updating Dom and moving him back into his category... ($num)");

		DB::table('operations.users')->where('id',10)->update(['mailing_list_id'=>70]);
   		$this->output->writeln("Updating Clive and moving him back into his category... ($num)");

		$total = DB::table('operations.users')->whereNotNull('ok_unsubscribed_at')->where('mailing_list_id','<>','90')->update(['mailing_list_id'=>90]);
		$this->output->writeln("Moving unsubscribed to list 90... ($total)");

		$total = DB::table('operations.users')->whereNotNull('ok_blacklisted_at')->where('mailing_list_id','<>','100')->update(['mailing_list_id'=>100]);
		$this->output->writeln("Moving blacklisted to list 100... ($total)");

        $message = CampaignWorker::instance()->process($test=true);
        $this->output->writeln($message);
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments($argument=null)
    {
        return $this->argument($argument);
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
