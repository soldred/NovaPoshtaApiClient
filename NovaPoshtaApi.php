<?php

// NOTE: This api was designed for PHP 5.6 and higher

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
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function getCities($cityName = "", $page = 1, $limit = 50) {
        $methodProperties = [
            "Page" => (string)$page,
            "Limit" => (string)$limit
        ];

        if (!empty($cityName)) {
            $methodProperties["FindByString"] = $cityName;
        }

        return $this->sendRequest("Address", "getCities", $methodProperties);
    }

    public function getWarehouseTypes(){
        return $this->sendRequest("Address", "getWarehouseTypes", new \stdClass());
    }

    public function getWarehouses($cityRef = "", $typeOfWarehouseRef = "", $page = 1, $limit = 50, $language = "UA"){

        if(empty($cityRef)) return false;

        $methodProperties = [
            "CityRef" => $cityRef,
            "TypeOfWarehouseRef" => $typeOfWarehouseRef,
            "Page" => (string)$page,
            "Limit" => (string)$limit,
            "Language" => (string)$language
        ];

        return $this->sendRequest("Address", "getWarehouses", $methodProperties);
    }

}