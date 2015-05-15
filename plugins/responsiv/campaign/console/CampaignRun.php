<?php namespace Responsiv\Campaign\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Responsiv\Campaign\Classes\CampaignManager;

class CampaignRun extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'campaign:run';

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
        CampaignManager::instance()->process();
        $this->output->writeln('Successfully performed campaign processing.');
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