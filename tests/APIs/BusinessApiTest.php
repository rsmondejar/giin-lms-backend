<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Business;

class BusinessApiTest extends TestCase
{
    use ApiTestTrait;
    use WithoutMiddleware;
    use DatabaseTransactions;

    private const API_URL_ENDPOINT = '/api/businesses/';

    /**
     * @test
     */
    public function test_create_business()
    {
        $business = Business::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            self::API_URL_ENDPOINT,
            $business
        );

        $this->assertApiResponse($business);
    }

    /**
     * @test
     */
    public function test_read_business()
    {
        $business = Business::factory()->create();

        $this->response = $this->json(
            'GET',
            self::API_URL_ENDPOINT . $business->id
        );

        $this->assertApiResponse($business->toArray());
    }

    /**
     * @test
     */
    public function test_update_business()
    {
        $business = Business::factory()->create();
        $editedBusiness = Business::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            self::API_URL_ENDPOINT . $business->id,
            $editedBusiness
        );

        $this->assertApiResponse($editedBusiness);
    }

    /**
     * @test
     */
    public function test_delete_business()
    {
        $business = Business::factory()->create();

        $this->response = $this->json(
            'DELETE',
            self::API_URL_ENDPOINT . $business->id
        );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            self::API_URL_ENDPOINT . $business->id
        );

        $this->response->assertStatus(404);
    }
}
