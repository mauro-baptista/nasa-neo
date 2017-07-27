<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface FeedContract
{
    /**
     * Call api endpoint, treat the
     * values and them persist
     * them on database
     *
     * @param int $days
     * @return int
     */
    public function getFeedAndStore(int $days) : int;

    /**
     * Pass trough all items from feed
     * and include them if new or
     * update them if exists
     *
     * @param Collection $items
     * @return int
     */
    public function store(Collection $items) : int;
}
