<?php

namespace Tests\Feature;

use App\Model\Neo;
use App\Repositories\Contracts\FeedContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommandFeedTest extends TestCase
{
    use DatabaseMigrations;

    public function get_feed($days = 3)
    {
        return app()->make(FeedContract::class)->getFeedFromEndpoint(
            Carbon::now()->format('Y-m-d'),
            Carbon::now()->subDays($days)->format('Y-m-d')
        );
    }
    /** @test */
    public function retrieve_items_from_endpoint_successfully()
    {
        $count = $this->get_feed(1)->get('element_count');

        Artisan::call('nasa:get-feed', [
            '--days' => '1',
        ]);

        $neos = Neo::count();

        $this->assertEquals($count, $neos);
    }
}
