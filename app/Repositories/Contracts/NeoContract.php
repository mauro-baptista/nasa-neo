<?php

namespace App\Repositories\Contracts;

interface NeoContract
{
    /**
     * Return all items that is hazardous
     * from the neo table
     *
     * @return mixed
     */
    public function getHazardous();

    /**
     * Return the fastest item on database
     * considering if it is hazardous
     * or not
     *
     * @return mixed
     */
    public function getFastest();

    /**
     * Return the year with more asteroids
     * considering if it is hazardous
     * or not
     *
     * @return mixed
     */
    public function getBestYear();

    /**
     * Return the month with more asteroids
     * considering if it is hazardous
     * or not
     *
     * @return mixed
     */
    public function getBestMonth();
}
