<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNewResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a weekly mail to artists informing them about new events that pop up in their neighbourhood';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
