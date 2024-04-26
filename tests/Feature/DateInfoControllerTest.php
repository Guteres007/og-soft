<?php

namespace Tests\Feature;

use App\Enums\DayType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class DateInfoControllerTest extends TestCase
{

    public function test_holiday(): void
    {

       $response = $this->json('GET', '/api/dates/date-info', ['date' => '2024-12-24']);

       $response
            ->assertStatus(200)
            ->assertJson([
                'day_type' => DayType::Holiday->value
            ]);

    }

     public function test_working_day(): void
    {

       $response = $this->json('GET', '/api/dates/date-info', ['date' => '2024-11-11']);

       $response
            ->assertStatus(200)
            ->assertJson([
                'day_type' => DayType::WorkingDay->value
            ]);

     }

     public function test_weekend(): void
    {

       $response = $this->json('GET', '/api/dates/date-info', ['date' => '2024-04-27']);

       $response
            ->assertStatus(200)
            ->assertJson([
                'day_type' => DayType::Weekend->value
            ]);

    }
}
