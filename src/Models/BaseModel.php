<?php
namespace NovaPoshta\Models;

use NovaPoshta\NovaPoshtaApiClient;

/**
 * Abstract base model for Nova Poshta API interaction.
 */
abstract class BaseModel {
    /**
     * @var NovaPoshtaApiClient A reference to the main API client instance.
     */
    protected $client;

    /**
     * BaseModel constructor.
     * @param NovaPoshtaApiClient $client  The main NovaPoshtaApiClient instance.
     */
    public function __construct(NovaPoshtaApiClient $client) {
        $this->client = $client;
    }

    /**
     * A proxy method to send a request via the main client.
     */
    protected function sendRequest($model, $method, $properties = []) {
        return $this->client->sendRequest($model, $method, $properties);
    }

    /**
     * Validates and filters fields based on the required/nullable rules.
     */
    protected function validateFields($fields, $data) {
        $missingFields = [];
        $validFields = [];

        if(empty($data)) return new \stdClass();

        foreach ($fields as $field => $rule) {
            if ($rule === "required" && (empty($data[$field]) && $data[$field] !== '0')) {
                $missingFields[] = $field;
            } elseif (isset($data[$field]) && $data[$field] !== '') {
                $validFields[$field] = $data[$field];
            }
        }

        if (!empty($missingFields)) {
            throw new \InvalidArgumentException("Missing required fields: " . implode(", ", $missingFields));
        }

        return $validFields;
    }
}