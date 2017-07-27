<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FeedContract;

class CommandController extends Controller
{
    /**
     * @var FeedContract
     */
    private $feed;

    public function __construct(FeedContract $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Call api endpoint, treat the
     * values and them persist
     * them on database
     *
     * @param int $days
     * @return int
     */
    public function store(int $days = 3) : int
    {
        return $this->feed->getFeedAndStore($days);
    }
}
