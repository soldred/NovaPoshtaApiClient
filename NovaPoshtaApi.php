<?php

/**
 * NovaPoshta API Client
 *
 * NOTE: This api was designed for PHP 5.6 and higher, but might work on older versions
 *
 * Official API Documentation  https://developers.novaposhta.ua/documentation
 */

namespace NovaPoshta;

class NovaPoshtaApi
{
    private $apiKey;
    private $apiUrl = "https://api.novaposhta.ua/v2.0/json/";
    private $errors;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function getValidatedFields($fields, $data, $context){
        $validFields = array();

        foreach($fields as $field => $rule){
            if($rule === "required"){
                if(empty($data[$field])){
                    $missingFields[] = $field;
                    continue;
                }
                $validFields[$field] = (string)$data[$field];
            }
            elseif($rule === "nullable"){
                if(!empty($data[$field])){
                    $validFields[$field] = (string)$data[$field];
                }
            }
        }

        if (!empty($missingFields)) {
            $this->errors = [
                'context' => $context,
                'missing_or_empty' => $missingFields
            ];
            return false;
        }

        return $validFields;
    }

    private function sendRequest($model, $method, $properties = array()){

        if(!empty($this->errors)){
            return (object)[
                'success' => false,
                'errors' => $this->errors
            ];
        }

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

    // Address model methods

    public function getCities($data)
    {
        $fields = array(
            "Ref" => "nullable",
            "Page" => "nullable",
            "FindByString" => "nullable",
            "Limit" => "nullable",
        );

        $methodProperties = $this->getValidatedFields($fields, $data, "getCities");

        return $this->sendRequest("Address", "getCities", $methodProperties);
    }

    public function getWarehouseTypes(){
        return $this->sendRequest("Address", "getWarehouseTypes", new \stdClass());
    }

    public function getWarehouses($data){
        $fields = array(
            "FindByString" => "nullable",
            "CityName" => "nullable",
            "CityRef" => "nullable",
            "Page" => "nullable",
            "Limit" => "nullable",
            "Language" => "nullable",
            "TypeOfWarehouse" => "nullable",
            "WarehouseId" => "nullable",
        );

        $methodProperties = $this->getValidatedFields($fields, $data, "getWarehouses");

        return $this->sendRequest("Address", "getWarehouses", $methodProperties);
    }

    //Counterparty model

    public function createPrivatePersonCounterparty($data){

        $fields = array(
            "FirstName"=>"required",
            "LastName"=>"required",
            "MiddleName"=>"required",
            "Phone"=>"required",
            "CounterpartyType"=>"required",
            "CounterpartyProperty"=>"required",
            "Email"=>"nullable"
        );

        $methodProperties = $this->getValidatedFields($fields, $data,"NovaPoshtaApi/createPrivatePersonCounterparty");

        return $this->sendRequest("Counterparty", "save", $methodProperties);
    }

    public function createThirdPersonCounterparty($data){
        // Do this next time you open an IDE
    }

    public function createOrganiztionCounterparty($data){
        // Do this next time you open an IDE
    }
}