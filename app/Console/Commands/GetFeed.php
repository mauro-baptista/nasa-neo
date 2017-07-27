<?php

namespace App\Console\Commands;

use App\Http\Controllers\CommandController;
use Illuminate\Console\Command;

class GetFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nasa:get-feed
                            {--d|days=3 : Get the feed from (Today - days) up to (Today) - Max 7 days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get feed from NEO (Near Earth Object Web Service)';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $amount = app()->make(CommandController::class)->store(
            (int) $this->option('days')
        );

        if (! app()->environment('testing')) {
            $this->line(printf("%s items saved on database", $amount));
        }
    }


}
