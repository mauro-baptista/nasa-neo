<?php

namespace Tests\Feature;

use App\Models\Neo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NeoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function call_hazardous_endpoint()
    {
        $hazardous = factory(Neo::class)->states('is_hazardous')->times(7)->create();
        factory(Neo::class)->states('is_not_hazardous')->times(11)->create();

        $response = $this->get('/hazardous');

        $response->assertStatus(200);
        $response->assertJson($hazardous->toArray());
    }

    /** @test */
    public function call_fastest_endpoint_to_non_hazardous_data()
    {
        $fastest = factory(Neo::class)->states('is_not_hazardous')->create([
            'speed' => 100,
        ]);

        factory(Neo::class)->states('is_hazardous')->times(7)->create([
            'speed' => 90,
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(11)->create([
            'speed' => 80,
        ]);

        $response = $this->get('/fastest?hazardous=false');

        $response->assertStatus(200);
        $response->assertJson($fastest->toArray());
    }

    /** @test */
    public function call_fastest_endpoint_to_hazardous_data()
    {
        $fastest = factory(Neo::class)->states('is_hazardous')->create([
            'speed' => 100,
        ]);

        factory(Neo::class)->states('is_hazardous')->times(7)->create([
            'speed' => 90,
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(11)->create([
            'speed' => 80,
        ]);

        $response = $this->get('/fastest?hazardous=true');

        $response->assertStatus(200);
        $response->assertJson($fastest->toArray());
    }

    /** @test */
    public function call_best_year_endpoint_to_non_hazardous_objects_data()
    {
        factory(Neo::class)->states('is_hazardous')->times(7)->create([
            'date' => '2017-05-01'
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(11)->create([
            'date' => '2016-05-01'
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(2)->create([
            'date' => '2015-05-01'
        ]);

        $response = $this->get('/best-year?hazardous=false');

        $response->assertStatus(200);
        $response->assertJson(['count' => 11, 'year' => 2016]);
    }

    /** @test */
    public function call_best_year_endpoint_to_hazardous_objects_data()
    {
        factory(Neo::class)->states('is_hazardous')->times(7)->create([
            'date' => '2017-05-01'
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(11)->create([
            'date' => '2016-05-01'
        ]);

        factory(Neo::class)->states('is_hazardous')->times(2)->create([
            'date' => '2015-05-01'
        ]);

        $response = $this->get('/best-year?hazardous=true');

        $response->assertStatus(200);
        $response->assertJson(['count' => 7, 'year' => 2017]);
    }

    /** @test */
    public function call_best_month_endpoint_to_non_hazardous_objects_data()
    {
        factory(Neo::class)->states('is_not_hazardous')->times(7)->create([
            'date' => '2017-07-01'
        ]);

        factory(Neo::class)->states('is_hazardous')->times(11)->create([
            'date' => '2017-05-01'
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(2)->create([
            'date' => '2016-07-01'
        ]);

        factory(Neo::class)->states('is_hazardous')->times(4)->create([
            'date' => '2015-07-01'
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(4)->create([
            'date' => '2015-03-01'
        ]);

        $response = $this->get('/best-month?hazardous=false');

        $response->assertStatus(200);
        $response->assertJson(['count' => 9, 'month' => 7]);
    }

    /** @test */
    public function call_best_month_endpoint_to_hazardous_objects_data()
    {
        factory(Neo::class)->states('is_not_hazardous')->times(7)->create([
            'date' => '2017-07-01'
        ]);

        factory(Neo::class)->states('is_hazardous')->times(11)->create([
            'date' => '2017-05-01'
        ]);

        factory(Neo::class)->states('is_not_hazardous')->times(2)->create([
            'date' => '2016-07-01'
        ]);

        factory(Neo::class)->states('is_hazardous')->times(4)->create([
            'date' => '2015-07-01'
        ]);

        factory(Neo::class)->states('is_hazardous')->times(4)->create([
            'date' => '2015-03-01'
        ]);

        $response = $this->get('/best-month?hazardous=true');

        $response->assertStatus(200);
        $response->assertJson(['count' => 11, 'month' => 5]);
    }
}
