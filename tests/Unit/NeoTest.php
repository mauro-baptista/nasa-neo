<?php

namespace Tests\Unit;

use App\Models\Neo;
use App\Repositories\Contracts\NeoContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NeoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function return_all_hazardous_data()
    {
        $hazardous = factory(Neo::class)->states('is_hazardous')->times(7)->create();
        factory(Neo::class)->states('is_not_hazardous')->times(11)->create();

        $neo = app()->make(NeoContract::class);

        $this->assertEquals(7, $neo->getHazardous()->count());
        $this->assertEquals($hazardous->toArray(), $neo->getHazardous()->toArray());
    }

    /** @test */
    public function return_the_fastest_data()
    {
        $fastest = factory(Neo::class)->create([
            'speed' => 100,
        ]);

        factory(Neo::class)->times(7)->create([
            'speed' => 90,
        ]);

        factory(Neo::class)->times(11)->create([
            'speed' => 80,
        ]);

        $neo = app()->make(NeoContract::class);

        $this->assertEquals($fastest->toArray(), $neo->getFastest()->toArray());
    }

    /** @test */
    public function return_year_with_most_objects_data()
    {
        factory(Neo::class)->times(7)->create([
            'date' => '2017-05-01'
        ]);

        factory(Neo::class)->times(11)->create([
            'date' => '2016-05-01'
        ]);

        factory(Neo::class)->times(2)->create([
            'date' => '2015-05-01'
        ]);

        $neo = app()->make(NeoContract::class);

        $this->assertEquals(['count' => 11, 'year' => 2016], $neo->getBestYear()->toArray());
    }

    /** @test */
    public function return_month_with_most_objects_data()
    {
        factory(Neo::class)->times(7)->create([
            'date' => '2017-07-01'
        ]);

        factory(Neo::class)->times(11)->create([
            'date' => '2017-05-01'
        ]);

        factory(Neo::class)->times(2)->create([
            'date' => '2016-07-01'
        ]);

        factory(Neo::class)->times(4)->create([
            'date' => '2015-07-01'
        ]);

        factory(Neo::class)->times(4)->create([
            'date' => '2015-03-01'
        ]);

        $neo = app()->make(NeoContract::class);

        $this->assertEquals(['count' => 13, 'month' => 7], $neo->getBestMonth()->toArray());
    }
}
