<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    public function call_main_endpoint()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertJson(["hello" => "world!"]);
    }
}
