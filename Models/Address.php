<?php
namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

/**
 * Class Address
 *
 * Provides methods for working with address-related data via Nova Poshta API.
 * Includes city directories, warehouse listings, street searches, and counterparty addresses.
 */
class Address extends BaseModel
{
    /**
     * Get a list of cities served by Nova Poshta.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a1e6f0a7-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Optional parameters:
     * - Ref — City identifier (REF).
     * - Page — Page number.
     * - FindByString — Search by city name.
     * - Limit — Number of results per page.
     *
     * @return mixed API response.
     */
    public function getCities($data = [])
    {
        $fields = [
            "Ref" => "nullable",
            "Page" => "nullable",
            "FindByString" => "nullable",
            "Limit" => "nullable",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Address", "getCities", $methodProperties);
    }

    /**
     * Get available warehouse types (e.g., parcel lockers, standard branches).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2587b53-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getWarehouseTypes()
    {
        return $this->sendRequest("Address", "getWarehouseTypes", new \stdClass());
    }

    /**
     * Get a list of warehouses (branches).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a2322f38-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Optional parameters:
     * - FindByString — Search by warehouse name.
     * - CityName — Search by city name.
     * - CityRef — City identifier (REF).
     * - Page — Page number.
     * - Limit — Number of results per page.
     * - Language — 'ua' or 'ru'. Default is 'ua'.
     * - TypeOfWarehouseRef — Warehouse type identifier (REF).
     * - WarehouseId — Exact warehouse ID.
     *
     * @return mixed API response.
     */
    public function getWarehouses($data = [])
    {
        $fields = [
            "FindByString" => "nullable",
            "CityName" => "nullable",
            "CityRef" => "nullable",
            "Page" => "nullable",
            "Limit" => "nullable",
            "Language" => "nullable",
            "TypeOfWarehouseRef" => "nullable",
            "WarehouseId" => "nullable",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Address", "getWarehouses", $methodProperties);
    }

    /**
     * Get a list of streets that Nova Poshta can deliver to.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a27c20d7-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $cityRef City identifier (REF).
     * @param string $findByString Street name search string.
     *
     * @return mixed API response.
     */
    public function getStreet($cityRef, $findByString)
    {
        if(empty($cityRef)){
            throw new \InvalidArgumentException('Missing required parameter: $cityRef');
        }

        if(!is_string($cityRef)){
            throw new \InvalidArgumentException('$cityRef must be a string.');
        }


        if(empty($findByString)){
            throw new \InvalidArgumentException('Missing required parameter: $findByString');
        }

        if(!is_string($findByString)){
            throw new \InvalidArgumentException('$findByString must be a string.');
        }

        return $this->sendRequest("Address", "getStreet", ["CityRef" => $cityRef, "FindByString" => $findByString]);
    }

    /**
     * Create a new counterparty address (sender or recipient).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a155d0d9-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - CounterpartyRef — Counterparty identifier (REF).
     * - StreetRef — Street identifier (REF).
     * - BuildingNumber — Building number.
     * - FlatNumber — Flat/apartment number.
     * Optional:
     * - Notes — Additional notes (optional, but must be string if provided).
     *
     * @return mixed API response.
     */
    public function createCounterpartyAddress($data = [])
    {
        $fields = [
            "CounterpartyRef" => "required",
            "StreetRef" => "required",
            "BuildingNumber" => "required",
            "FlatNumber" => "required",
            "Notes" => "nullable",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Address", "save", $methodProperties);
    }

    /**
     * Delete a counterparty address by its Ref.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a177069a-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Address identifier (REF) to delete.
     * @return mixed API response.
     */
    public function deleteCounterpartyAddress($ref)
    {
        if(empty($ref)){
            throw new \InvalidArgumentException('Missing required parameter: $ref');
        }

        if(!is_string($ref)){
            throw new \InvalidArgumentException('$ref must be a string');
        }

        return $this->sendRequest("Address", "delete", ["Ref" => $ref]);
    }

    /**
     * Update an existing counterparty address.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a0cf0f5f-8512-11ec-8ced-005056b2dbe1/method/a19ba934-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - Ref — Address reference to update.
     * Optional:
     * - CounterpartyRef — Updated counterparty identifier (REF).
     * - StreetRef — Updated street identifier (REF).
     * - BuildingNumber — Updated building number.
     * - Flat — Updated flat/apartment number.
     * - Note — Updated note.
     *
     * @return mixed API response.
     */
    public function updateCounterpartyAddress($data)
    {
        $fields = [
            "CounterpartyRef" => "nullable",
            "StreetRef" => "nullable",
            "BuildingNumber" => "nullable",
            "Flat" => "nullable",
            "Note" => "nullable",
            "Ref" => "required",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Address", "update", $methodProperties);
    }
}
