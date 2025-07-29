<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

class InternetDocument extends BaseModel
{

    /**
     * THIS METHOD IS NOT DONE YET.
     * I'M NOT SURE IF IT IS WORKING
     *
     * This method allows you to calculate the cost of shipping cargo.
     * The method allows you to calculate not only the shipment of cargo, but also tires and rims, pallets, and documents.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a91f115b-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string|object|array> $data Required:
     * - CitySender — Identifier (REF) of the sender's city.
     * - CityRecipient — Identifier (REF) of the recipient's city.
     * - Weight — Actual weight, min - 0.1, measured in kg.
     * - ServiceType — you can get if from Common->getServiceTypes().
     * - Cost — Estimated value, integer (if no value is specified, API will automatically set the minimum estimated value = 300.00).
     * - CargoType — Cargo type: Cargo, Documents, TiresWheels, Pallet.
     * - SeatsAmount — Number of departure locations, integer(string)
     * - RedeliveryCalculate — Return delivery. SHOULD be an OBJECT.
     * - PackCount — Number of packages.
     * - PackRef — Packaging identifier (REF).
     * - Amount — Integer(string) (reverse delivery amount/number of units)
     * - CargoDetails — Array with cargo details. Should include:
     * - - CargoDescription — Shipment type identifier (REF), from Common->getCargoTypes(), Common->getTiresWheelsList() etc.
     * - - Amount — Integer, amount (for example 2 tires)
     * - CargoDescription — Identifier (REF) of the shipment type, you can get from Common->getCargoDescriptionList()
     *
     * @return mixed API Response
     */
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

    /**
     * This method will display the estimated delivery date in the response.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/aa1b448f-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - ServiceType — Type of service, you can get if from Common->getServiceTypes().
     * - CitySender — Sender city identifier (REF)
     * - CityRecipinet — Recipient city identifier(REF)
     * Optional:
     * - DateTime — Date of creation of interned document.
     *
     * @return mixed API response
     */
    public function getDocumentDeliveryDate($data){
        $fields = array(
            "DateTime" => "nullable",
            "ServiceType" => "required",
            "CitySender" => "required",
            "CityRecipient" => "required",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "getDocumentDeliveryDate", $methodProperties);
    }

    /**
     *
     */
    public function deleteDocument($ref){
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('Expected string parameter: $ref');
        }

        return $this->sendRequest("InternetDocument", "delete", ["DocumentRefs" => $ref]);
    }

    /**
     * This method will return all EN numbers created in the personal account and their identifiers (Ref) in the API.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/a9d22b34-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - DateTimeFrom — Date time from
     * - DateTimeTo — Date time to
     * - GetFullList — If 0, paginated loading works; if 1, the entire list (but no more than 500 documents).
     * Optional:
     * - DateTime — Date of creation of interned document.
     * - RedeliveryMoney — the ability to display all interned documents with return delivery (Money Transfer or Cash Outpost) “RedeliveryMoney” with a value of “1”.
     */
    public function getDocumentList($data){
        $fields = array(
            "DateTimeFrom" => "required",
            "DateTimeTo" => "required",
            "Page" => "nullable",
            "GetFullList" => "required",
            "DateTime" => "nullable",
            "RedeliveryMoney" => "nullable",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("InternetDocument", "getDocumentList", $methodProperties);
    }
}