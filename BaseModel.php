<?php

namespace NovaPoshta;

/**
 * Abstract base model for Nova Poshta API interaction.
 */
abstract class BaseModel {
    /**
     * @var string API key for authentication.
     */
    protected $apiKey;

    /**
     * @var string Base URL of the Nova Poshta API.
     */
    protected $apiUrl;

    /**
     * BaseModel constructor.
     *
     * @param string $apiKey  Nova Poshta API key.
     * @param string $apiUrl  API base URL (e.g. https://api.novaposhta.ua/v2.0/json/).
     */
    public function __construct($apiKey, $apiUrl) {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Sends a request to Nova Poshta API.
     *
     * @param string $model     The model name (e.g. "Counterparty", "Common").
     * @param string $method    The method name to call on the API.
     * @param array|\stdClass $properties Optional method properties.
     *
     * @return mixed Decoded JSON response from the API.
     */
    protected function sendRequest($model, $method, $properties = []) {
        $requestData = [
            "apiKey" => $this->apiKey,
            "modelName" => $model,
            "calledMethod" => $method,
            "methodProperties" => $properties,
        ];
//
//        var_dump($requestData);
//        exit;

        $curl = curl_init($this->apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    /**
     * Validates and filters fields based on the required/nullable rules.
     *
     * @param array<string, string> $fields Key-value pairs of field names and rules ("required" or "nullable").
     * @param array<string, mixed> $data    Input data.
     *
     * @return array<string, string>|\stdClass Filtered and validated data. Returns \stdClass if input is empty.
     *
     * @throws \InvalidArgumentException If required fields are missing.
     */
    protected function validateFields($fields, $data) {
        $missingFields = [];
        $validFields = [];

        if(empty($data)) return new \StdClass();

        foreach ($fields as $field => $rule) {
            if ($rule === "required" && (empty($data[$field]) && $data[$field] !== '0')) {
                $missingFields[] = $field;
            } elseif (isset($data[$field]) && $data[$field] !== '') {
                $validFields[$field] = (string)$data[$field];
            }
        }

        if (!empty($missingFields)) {
            throw new \InvalidArgumentException("Missing required fields: " . implode(", ", $missingFields));
        }

        return $validFields;
    }
}
