<?php

namespace App\Repositories;

use App\Models\Neo;
use App\Repositories\Contracts\FeedContract;
use Carbon\Carbon;
use GuzzleHttp;
use Illuminate\Support\Collection;

class FeedRepository implements FeedContract
{
    private $neo;

    public function __construct(Neo $neo)
    {
        $this->neo = $neo;
    }

    /**
     * Call api endpoint, treat the
     * values and them persist
     * them on database
     *
     * @param int $days
     * @return int
     */
    public function getFeedAndStore(int $days) : int
    {
        return $this->store(
            $this->getFeed($days)
        );
    }

    /**
     * Pass trough all items from feed
     * and include them if new or
     * update them if exists
     *
     * @param Collection $items
     * @return int
     */
    public function store(Collection $items) : int
    {
        $items->each(function ($item) {
            $this->neo->updateOrCreate(
                ['reference' => $item['reference']],
                $item
            );
        });

        return $items->count();
    }

    /**
     * Get feed and treat its data
     * to fit database needs
     *
     * @param int $days
     * @return \Illuminate\Support\Collection
     */
    public function getFeed(int $days) : Collection
    {
        list($startDate, $endDate) = $this->getDates($days);
        $feed = $this->getFeedFromEndpoint($startDate, $endDate)->get('near_earth_objects');

        return collect($feed)->map(function ($item, $date) {
            return $this->treatFeedToDB($item, $date);
        })->flatten(1);
    }

    /**
     * Treat feed from NASA to fit the
     * fields needed on database
     *
     * @param array $item
     * @param string $date
     * @return \Illuminate\Support\Collection
     */
    private function treatFeedToDB(array $item, string $date) : Collection
    {
        return collect($item)->map(function ($item) use ($date) {
            return [
                'date' => $date,
                'reference' => $item->neo_reference_id,
                'name' => $item->name,
                'speed' => $item->close_approach_data[0]->relative_velocity->kilometers_per_hour,
                'is_hazardous' => $item->is_potentially_hazardous_asteroid,
            ];
        });
    }

    /**
     * Call NASA API endpoint to
     * retrieve information
     *
     * @param $startDate
     * @param $endDate
     * @return \Illuminate\Support\Collection
     */
    private function getFeedFromEndpoint($startDate, $endDate) : Collection
    {
        $client = new GuzzleHttp\Client();

        $response = $client->get(vsprintf('%sfeed?start_date=%s&end_date=%s&detailed=false&api_key=%s', [
            config('nasa.endpoint'),
            $startDate,
            $endDate,
            config('nasa.api_token')
        ]));

        return collect(json_decode($response->getBody()));
    }

    /**
     * Get dates that will be searched
     * on the API request
     *
     * @param int $days
     * @return array
     */
    private function getDates(int $days) : array
    {
        $today = Carbon::now();

        return [
            $today->format('Y-m-d'),
            $today->subDays($days)->format('Y-m-d'),
        ];
    }
}