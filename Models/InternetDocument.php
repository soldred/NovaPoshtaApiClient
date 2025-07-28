<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

class InternetDocument extends BaseModel
{
    public function getDocumentPrice($data){
        $fields = array(
            "CitySender" => "required", // ref
            "CityRecipient" => "required", // ref
            "Weight" => "required",
            "ServiceType" => "required",
            "Cost" => "required",
            "CargoType" => "required", //Cargo, Documents, TiresWheels, Pallet
            "SeatsAmount" => "required",
            "RedeliveryCalculate" => "nullable",
            "PackCount" => "nullable",
            "PackRef" => "nullable",
            "Amount" => "nullable",
            "CargoDetails" => "nullable",
            "CargoDescription" => "nullable",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "getDocumentPrice", $methodProperties);
    }

    public function getDocumentDeliveryDate($data){
        $fields = array(
            "DateTime" => "nullable",
            "ServiceType" => "required",
            "CitySender" => "required", // ref
            "CityRecipient" => "required", // ref
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "getDocumentDeliveryDate", $methodProperties);
    }

    public function createDocument($data){
        $fields = array(
            "SenderWarehouseIndex" => "nullable",
            "RecipientWarehouseIndex" => "nullable",
            "PayerType" => "required", // Sender, Recipient, ThirdPerson
            "PaymentMethod" => "required", // Cash/NonCash
            "DateTime" => "required",
            "CargoType" => "required",
            "VolumeGeneral" => "nullable",
            "Weight" => "required",
            "ServiceType" => "required",
            "SeatsAmount" => "required",
            "Description" => "required",
            "Cost" => "required",
            "CitySender" => "required", // ref
            "Sender" => "required", // ref ?
            "SenderAddress" => "required", // ref Список адрес контрагента
            "ContactSender" => "required", // ref Список контактних осіб контрагента
            "SendersPhone" => "required",
            "Recipient" => "required", // ref ?
            "RecipientAddress" => "required", // ref ?
            "ContactRecipient" => "required",
            "RecipientsPhone" => "required",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "save", $methodProperties);
    }

    public function createDocumentToPost($data){
        $fields = array(
            "SenderWarehouseIndex" => "nullable",
            "RecipientWarehouseIndex" => "nullable",
            "PayerType" => "required", // Sender, Recipient, ThirdPerson
            "PaymentMethod" => "required", // Cash/NonCash
            "DateTime" => "required",
            "CargoType" => "required",
            "Weight" => "required",
            "ServiceType" => "required",
            "SeatsAmount" => "required",
            "Description" => "required",
            "Cost" => "required",
            "CitySender" => "required", // ref
            "Sender" => "required", // ref ?
            "SenderAddress" => "required", // ref Список адрес контрагента
            "ContactSender" => "required", // ref Список контактних осіб контрагента
            "CityRecipient" => "required", // ref
            "Recipient" => "required", // ref
            "RecipientAddress" => "required", // ref поштомату
            "ConctactRecipient" => "required", // ref
            "RecipientsPhone" => "required",
            "OptionsSeat" => "required", // array
        );

//        $OptionsSeat = array(
//            "volumetricVolume" => "1",
//            "volumetricWidth" => "30",
//            "volumetricLength" => "30",
//            "volumetricHeight" => "30",
//            "weight" => "20"
//        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "save", $methodProperties);
    }

    public function deleteDocument($ref){
        return $this->sendRequest("InternetDocument", "delete", ["DocumentRefs" => $ref]);
    }

    public function getDocumentList($data){
        $fields = array(
            "DateTimeFrom" => "required",
            "DateTimeTo" => "required",
            "Page" => "nullable",
            "GetFullList" => "required",
            "DateTime" => "nullable",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "getDocumentList", $methodProperties);
    }
}