<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

/**
 * Class Common
 *
 * Provides access to general reference data via Nova Poshta API.
 * Includes cargo types, pallets, packing, service types, time intervals, etc.
 */
class Common extends BaseModel
{
    /**
     * Get a list of time intervals for delivery (for use with Time Intervals service).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a56d5c1c-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Required:
     * - RecipientCityRef — Recipient city identifier (REF).
     * Optional:
     * - DateTime — Date for available intervals (format: dd.mm.YYYY). Defaults to current date.
     *
     * @return mixed API response.
     */
    public function getTimeIntervals($data = []) {
        $fields = [
            "RecipientCityRef" => "required",
            "DateTime" => "nullable"
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Common", "getTimeIntervals", $methodProperties);
    }

    /**
     * Get a list of cargo types in Ukrainian.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5912a1e-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getCargoTypes() {
        return $this->sendRequest("Common", "getCargoTypes", new \stdClass());
    }

    /**
     * Get list of return delivery cargo types (in Ukrainian and Russian).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5b46873-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getBackwardDeliveryCargoTypes() {
        return $this->sendRequest("Common", "getBackwardDeliveryCargoTypes", new \stdClass());
    }

    /**
     * Get a list of pallet types.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a5dd575e-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getPalletsList() {
        return $this->sendRequest("Common", "getPalletsList", new \stdClass());
    }

    /**
     * Get return delivery payer types in Ukrainian and English (e.g. Sender, Recipient).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6247f2f-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getTypesOfPayersForRedelivery() {
        return $this->sendRequest("Common", "getTypesOfPayersForRedelivery", new \stdClass());
    }

    /**
     * Get cargo packing types.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6492db4-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Optional:
     * - Lengthstring — Length.
     * - Widthstring — Width.
     * - Heightstring — Height.
     * - VolumetricWeightstring — Volume.
     * - TypeOfPackingstring — Packing type.
     *
     * @return mixed API response.
     */
    public function getPackList($data = []) {
        $fields = [
            "Lengthstring" => "nullable",
            "Widthstring" => "nullable",
            "Heightstring" => "nullable",
            "VolumetricWeightstring" => "nullable",
            "TypeOfPackingstring" => "nullable",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Common", "getPackList", $methodProperties);
    }

    /**
     * Get a list of tyre and wheel types (used for respective cargo).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a66fada0-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getTiresWheelsList() {
        return $this->sendRequest("Common", "getTiresWheelsList", new \stdClass());
    }

    /**
     * Get cargo descriptions (searchable).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a697db47-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $data Optional:
     * - FindByString — Search string.
     * - Page — Page number.
     *
     * @return mixed API response.
     */
    public function getCargoDescriptionList($data = []) {
        $fields = [
            "FindByString" => "nullable",
            "Page" => "nullable",
        ];

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("Common", "getCargoDescriptionList", $methodProperties);
    }

    /**
     * Get error message reference book.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6bce5a1-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getMessageCodeText() {
        return $this->sendRequest("CommonGeneral", "getMessageCodeText", new \stdClass());
    }

    /**
     * Get a list of delivery service types (e.g., warehouse-to-door).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a6e189f7-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getServiceTypes() {
        return $this->sendRequest("Common", "getServiceTypes", new \stdClass());
    }

    /**
     * Get a list of ownership forms.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/a754ff0d-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getOwnershipFormsList() {
        return $this->sendRequest("Common", "getOwnershipFormsList", new \stdClass());
    }

    /**
     * Get available pickup time intervals for a specific sender city and date.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a55b2c64-8512-11ec-8ced-005056b2dbe1/method/c4389a2c-eaaf-11ef-84e0-48df37b921da
     *
     * @param string $senderCityRef Sender city identifier (REF).
     * @param string $dateTime Date in format dd.mm.YYYY.
     *
     * @return mixed API response.
     */
    public function getPickupTimeIntervals($senderCityRef, $dateTime) {
        if(empty($senderCityRef)){
            throw new \InvalidArgumentException('Missing required parameter: $senderCityRef.');
        }

        if(!is_string($senderCityRef)){
            throw new \InvalidArgumentException('$scanSheetRefs must be a string.');
        }

        if(empty($dateTime)){
            throw new \InvalidArgumentException('Missing required parameter: $dateTime.');
        }

        if(!is_string($dateTime)){
            throw new \InvalidArgumentException('$scanSheetRefs must be a string. Format should be dd.mm.YYYY');
        }

        return $this->sendRequest("Common", "getPickupTimeIntervals", [
            "SenderCityRef" => $senderCityRef,
            "DateTime" => $dateTime,
        ]);
    }
}