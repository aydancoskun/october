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

   		$this->output->writeln("Updating mailed to in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 60 WHERE ".
				"u.id = 2";
    	DB::statement( DB::raw($sql) );
   		$this->output->writeln("Updating mailed to in subscriber table... ");
		$sql =	"UPDATE leancode_campaign_lists_subscribers cls LEFT JOIN operations.users u ON cls.subscriber_id = u.id ".
				"SET cls.list_id = 70 WHERE ".
				"u.id = 10";
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
