<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

class ContactPerson extends BaseModel
{
    /**
     * Create a contact person for the sender/recipient counterparty.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a39040c4-8512-11ec-8ced-005056b2dbe1/method/a3a25bda-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - CounterpartyRef — Counterparty identifier (REF)
     * - FirstName — First name.
     * - LastName — Last name.
     * - MiddleName — Middle name.
     * - Phone — Phone number (example 380997979789).
     *
     * @return mixed API response.
     */
    public function createContactPerson($data){
        $fields = array(
            "CounterpartyRef" => "required",
            "FirstName" => "required",
            "MiddleName" => "required",
            "LastName" => "required",
            "Phone" => "required",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("ContactPerson", "save", $methodProperties);
    }

    /**
     *  Update a contact person for the sender/recipient counterparty.
     *
     *  API reference:
     *  https://developers.novaposhta.ua/view/model/a39040c4-8512-11ec-8ced-005056b2dbe1/method/a3c5a577-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - CounterpartyRef — Counterparty identifier (REF).
     * - Ref — Contact person counterparty identifier (REF).
     * - FirstName — First name.
     * - LastName — Last name.
     * - MiddleName — Middle name.
     * Phone — Phone number (example 380997979789).
     *
     * @return mixed API response.
     */
    public function updateContactPerson($data){
        $fields = array(
            "CounterpartyRef" => "required",
            "Ref" => "required",
            "FirstName" => "required",
            "MiddleName" => "required",
            "LastName" => "required",
            "Phone" => "required",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("ContactPerson", "update", $methodProperties);
    }

    /**
     * Delete a contact person for the sender/recipient counterparty.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a39040c4-8512-11ec-8ced-005056b2dbe1/method/a3ea91c8-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Contact person counterparty identifier (REF). You can get using NovaPoshta\Models\Counterparty->getCounterpartyContactPersons($ref) method
     * @return mixed API response.
     */
    public function deleteContactPerson($ref){
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref.');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('$ref must be a string.');
        }

        return $this->sendRequest("ContactPerson", "delete", array("Ref" => $ref));
    }
}