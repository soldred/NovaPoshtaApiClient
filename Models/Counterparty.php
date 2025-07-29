<?php
namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

class Counterparty extends BaseModel {
    const TYPE_PRIVATE_PERSON = 'PrivatePerson';
    const TYPE_ORGANIZATION = 'Organization';

    const PROPERTY_SENDER = 'Sender';
    const PROPERTY_RECIPIENT = 'Recipient';
    const PROPERTY_THIRD_PERSON = 'ThirdPerson';

    const FIELDS_MAP = [
        self::TYPE_PRIVATE_PERSON => [
            self::PROPERTY_RECIPIENT => [
                "FirstName" => "required",
                "MiddleName" => "required",
                "LastName" => "required",
                "Phone" => "required",
                "Email" => "nullable",
            ],
            self::PROPERTY_SENDER => [
                "FirstName" => "required",
                "MiddleName" => "required",
                "LastName" => "required",
                "Phone" => "required",
                "Email" => "nullable",
            ]
        ],
        self::TYPE_ORGANIZATION => [
            self::PROPERTY_RECIPIENT => [
                "EDRPOU" => "required",
                "CityRef" => "nullable",
                "Phone" => "nullable",
                "Email" => "nullable",
            ],
            self::PROPERTY_SENDER => [
                "EDRPOU" => "required",
                "CityRef" => "nullable",
                "Phone" => "nullable",
                "Email" => "nullable",
            ],
            self::PROPERTY_THIRD_PERSON => [
                "FirstName" => "nullable",
                "MiddleName" => "nullable",
                "LastName" => "nullable",
                "Phone" => "nullable",
                "Email" => "nullable",
                "EDRPOU" => "required",
                "CityRef" => "nullable",
            ],
        ],
    ];

    /**
     * Creates a new counterparty (Sender, Recipient, or ThirdPerson) for the given type.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/0ae5dd75-8a5f-11ec-8ced-005056b2dbe1
     *
     * The required structure of $data depends on both $type and $property.
     *
     * @param array<string, string> $data Associative array of counterparty fields.
     *
     * @param string $type Type of counterparty. One of:
     *   - self::TYPE_PRIVATE_PERSON
     *   - self::TYPE_ORGANIZATION
     *
     * @param string $property Role of the counterparty. One of:
     *   - self::PROPERTY_SENDER
     *   - self::PROPERTY_RECIPIENT
     *   - self::PROPERTY_THIRD_PERSON
     *
     * Required fields per combination:
     *
     * - PrivatePerson + Sender or Recipient:
     *   - FirstName (required)
     *   - MiddleName (required)
     *   - LastName (required)
     *   - Phone (required)
     *   - Email (optional)
     *
     * - Organization + Sender or Recipient:
     *   - EDRPOU (required)
     *   - CityRef (optional)
     *   - Phone (optional)
     *   - Email (optional)
     *
     * - Organization + ThirdPerson:
     *   - EDRPOU (required)
     *   - FirstName (optional)
     *   - MiddleName (optional)
     *   - LastName (optional)
     *   - CityRef (optional)
     *   - Phone (optional)
     *   - Email (optional)
     *
     * @return mixed The API response.
     *
     * @throws \InvalidArgumentException If the $type or $property is invalid.
     *
     * @see self::FIELDS_MAP For full mapping of fields per type/property.
     */

    public function createCounterparty($data, $type, $property) {
        if (!array_key_exists($type, self::FIELDS_MAP) || !array_key_exists($property, self::FIELDS_MAP[$type])) {
            throw new \InvalidArgumentException("Unknown counterparty type ('$type') or property ('$property')");
        }

        $fields = self::FIELDS_MAP[$type][$property];
        $methodProperties = $this->validateFields($fields, $data);

        $methodProperties['CounterpartyType'] = $type;
        $methodProperties['CounterpartyProperty'] = $property;

        return $this->sendRequest("Counterparty", "save", $methodProperties);
    }

    /**
     * Get the parameters of the sender's counterparty in terms of the possibility of ordering additional services, from the section: ‘Формування запиту на створення ЕН із додатковими послугами.’ Services can be ordered through a personal manager.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a332efbf-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Counterparty identifier (REF).
     *
     * @return mixed Api response.
     */
    public function getCounterpartyOptions($ref){
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('$ref must be a string.');
        }

        return $this->sendRequest("Counterparty", "getCounterpartyOptions", ["Ref" => $ref]);
    }

    /**
     * Get a list of sender/recipient counterparties.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a30dbb7c-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Counterparty identifier (REF)
     * @param string $counterpartyProperty CounterpartyProperty — One of:
     * - self::PROPERTY_SENDER
     * - self::PROPERTY_RECIPIENT
     * - self::PROPERTY_THIRD_PERSON
     *
     * @return mixed API response.
     */
    public function getCounterpartyAddresses($ref, $counterpartyProperty){
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref.');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('$ref must be a string.');
        }

        if(empty($counterpartyProperty)){
            throw new \InvalidArgumentException('Missing required parameter: $ref. Use self::PROPERTY_ constants');
        }

        if(!is_string($counterpartyProperty)){
            throw new \InvalidArgumentException('$ref must be a string. Use self::PROPERTY_ constants');
        }


        return $this->sendRequest("Counterparty", "getCounterpartyAddresses", ["Ref" => $ref, "CounterpartyProperty" => $counterpartyProperty]);
    }

    /**
     * Update counterparty.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a2c3c708-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - Ref — Contact person counterparty identifier (REF).
     * - CityRef — City identifier (REF).
     * - FirstName — First name.
     * - MiddleName — Middle name.
     * - LastName — Last name.
     * - Email — Email
     * - CounterpartyType — One of:
     * - self::TYPE_PRIVATE_PERSON
     * - self::TYPE_ORGANIZATION
     * - CounterpartyProperty — One of:
     * - self::PROPERTY_SENDER
     * - self::PROPERTY_RECIPIENT
     * - self::PROPERTY_THIRD_PERSON
     * Optional:
     * - Phone — Phone number (example 380997979789).
     */
    public function updateCounterparty($data) {
        $fields = [
            "Ref" => "required",
            "CityRef" => "required",
            "FirstName" => "required",
            "MiddleName" => "required",
            "LastName" => "required",
            "Phone" => "nullable",
            "Email" => "required",
            "CounterpartyType" => "required",
            "CounterpartyProperty" => "required",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Counterparty", "update", $methodProperties);
    }

    /**
     * Delete the recipient's counterparty.
     * Only recipients can be deleted via API. Sender deletion requires contacting the manager.
     *
     * API reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a2eb27e8-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Counterparty identifier (REF).
     * @return mixed API Response.
     */
    public function deleteCounterparty($ref) {
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('$ref must be a string.');
        }

        return $this->sendRequest("Counterparty", "delete", ["Ref" => $ref]);
    }

    /**
     * Get a list of counterparty contact persons
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a3575a67-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Counterparty identifier (REF)
     * @return mixed API response.
     */
    public function getCounterpartyContactPersons($ref) {
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('$ref must be a string.');
        }

        return $this->sendRequest("Counterparty", "getCounterpartyContactPersons", ["Ref" => $ref]);
    }

    /**
     * Get a list of senders, recipients, and third counterparties.
     * If there are more than 100 sender or recipient counterparties in the method, you must use the ‘Page’ parameter.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a37a06df-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - CounterpartyProperty — One of:
     * - self::PROPERTY_SENDER
     * - self::PROPERTY_RECIPIENT
     * - self::PROPERTY_THIRD_PERSON
     * Optional:
     * - FindByString – Search counterparty by name
     * - Page – Page number
     */
    public function getCounterparties($data){
        $fields = array(
            "CounterpartyProperty" => "required",
            "FindByString" => "nullable",
            "Page" => "nullable"
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("CounterpartyGeneral", "getCounterparties", $methodProperties);
    }
}