<?php

// NOTE: This api was designed for PHP 5.6+

namespace NovaPoshta;

class NovaPoshtaApi
{
    private $apikey;
    private $apiUrl = "https://api.novaposhta.ua/v2.0/json/";

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function sendRequest($model, $method, $properties = array()){
        $requestData = array(
            "apiKey" => $this->apiKey,
            "modelName" => $model,
            "calledMethod" => $method,
            "methodProperties" => $properties
        );

        $curl = curl_init($this->apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function getCities($findByString = '', $page = 1, $limit = 50) {
        $methodProperties = [
            "Page" => (string)$page,
            "Limit" => (string)$limit
        ];

        if (!empty($findByString)) {
            $methodProperties["FindByString"] = $findByString;
        }

        return $this->sendRequest('Address', 'getCities', $methodProperties);
    }

}