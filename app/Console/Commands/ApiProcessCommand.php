<?php

namespace App\Console\Commands;

use App\Helpers\ApiProperties;
use Illuminate\Console\Command;

class ApiProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get API properties';

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

        $api = new ApiProperties();
        $api->get();

    }
}
