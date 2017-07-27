<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\NeoContract;

class NeoController extends Controller
{
    /**
     * @var NeoContract
     */
    private $neo;

    public function __construct(NeoContract $neo)
    {
        $this->neo = $neo;
    }

    /**
     * Return all items that is hazardous
     * from the neo table
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function hazardous()
    {
        return response()->json($this->neo->getHazardous(), 200);
    }

    /**
     * Return the fastest object
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fastest()
    {
        return response()->json($this->neo->getFastest(), 200);
    }

    /**
     * Return the year with
     * more objects
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function bestYear()
    {
        return response()->json($this->neo->getBestYear(), 200);
    }

    /**
     * Return the month with
     * more objects
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function bestMonth()
    {
        return response()->json($this->neo->getBestMonth(), 200);
    }
}
