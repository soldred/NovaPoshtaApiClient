<?php

namespace NovaPoshta\Models;

use http\Exception\InvalidArgumentException;
use NovaPoshta\BaseModel;

class Tracking extends BaseModel
{
    /**
     * This method allows users to obtain up-to-date information about the status of their shipments, including information about the sender and recipient.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a99d2f28-8512-11ec-8ced-005056b2dbe1/method/a9ae7bc9-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, string> $documents
     * - DocumentNumber (required) — ТТН
     * - Phone (optional) — phone number(recipient or sender).
     * If you're using your own API key from the https://new.novaposhta.ua/dashboard/settings/developers this field is not required.
     * Otherwise, provide the phone number to receive(if you need) the CreatedOnTheBasis field.
     * @return mixed API response
     */
    public function getStatusDocuments($documents = []){
        if(!is_array($documents)){
            throw new InvalidArgumentException('$documents should be an array');
        }

        return $this->sendRequest("TrackingDocument", "getStatusDocuments", ["Documents" => $documents]);
    }
}