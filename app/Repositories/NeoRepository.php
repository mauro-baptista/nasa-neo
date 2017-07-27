<?php

namespace App\Repositories;

use App\Models\Neo;
use App\Repositories\Contracts\NeoContract;

class NeoRepository implements NeoContract
{
    private $neo;

    public function __construct(Neo $neo)
    {
        $this->neo = $neo;
    }

    /**
     * Return all items that is hazardous
     * from the neo table
     *
     * @return mixed
     */
    public function getHazardous()
    {
        return $this->neo->isHazardous()->get();
    }

    /**
     * Return the fastest item on database
     * considering if it is hazardous
     * or not
     *
     * @return mixed
     */
    public function getFastest()
    {
        $hazardous = $this->getHazardousArgument();

        return $this->neo->isHazardous($hazardous)->fastest()->first();
    }

    /**
     * Return the year with more asteroids
     * considering if it is hazardous
     * or not
     *
     * @return mixed
     */
    public function getBestYear()
    {
        $hazardous = $this->getHazardousArgument();

        return $this->neo->isHazardous($hazardous)->countIn('year')->first();
    }

    /**
     * Return the month with more asteroids
     * considering if it is hazardous
     * or not
     *
     * @return mixed
     */
    public function getBestMonth()
    {
        $hazardous = $this->getHazardousArgument();

        return $this->neo->isHazardous($hazardous)->countIn('month')->first();
    }

    /**
     * Get from request the value for
     * the hazardous argument
     *
     * @return bool
     */
    private function getHazardousArgument() : bool
    {
        return request()->hazardous === 'true';
    }
}
