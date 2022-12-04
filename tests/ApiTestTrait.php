<?php

namespace Tests;

trait ApiTestTrait
{
    private $response;
    public function assertApiResponse(array $actualData): void
    {
        $this->assertApiSuccess();

        $response = json_decode($this->response->getContent(), true);
        $responseData = $response['data'];

        $this->assertNotEmpty($responseData['id']);
        $this->assertModelData($actualData, $responseData);
    }

    public function assertApiSuccess(): void
    {
        $this->response->assertStatus(200);
        $this->response->assertJson(['success' => true]);
    }

    public function assertModelData(array $actualData, array $expectedData): void
    {
        foreach ($actualData as $key => $value) {
            if (in_array($key, ['created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }
            $this->assertEquals($actualData[$key], $expectedData[$key]);
        }
    }
}
