<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;
class Courier extends BaseModel
{
    /**
     * Get a list of existing requests for “Courier Call.” Requests with any status are displayed. The display period for requests is 7 days from the date of their creation.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/6ed8c0ea-eabd-11ef-84e0-48df37b921da
     *
     * @return mixed API response.
     */
    public function getOrdersListCourierCall(){
        return $this->sendRequest("CarCallGeneral", "getOrdersListCourierCall", new \stdClass());
    }

    /**
     * This method allows you to add internet documents(packages) to the “Виклик кур’єра” request, which will be transferred to the courier as part of this request.
     * This method supports several options for adding documents: one document at a time or in bulk.
     * The main part of the method is the same, only the number of documents added differs.
     *
     * You can add IDs from different counterparties who work in the same corporate account (one login) or send from one counterparty but
     * create shipments in different accounts from different contact persons of that counterparty to the application.
     *
     * Check the official API documentation for this method
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/730e80bc-eab9-11ef-84e0-48df37b921da
     *
     * @param array<string> $linkedDocuments Internet documents(packages) that will be handed over to the courier as part of this application
     * @param string $number Courier call request number
     *
     * @return mixed API response.
     */
    public function insertDocuments($linkedDocuments, $number){
        $methodProperties['LinkedDocuments'] = $linkedDocuments;
        $methodProperties['Number'] = $number;

        return $this->sendRequest("CarCallGeneral", "insertDocuments", $methodProperties);
    }

    /**
     * This method allows you to get a list of existing “Виклик кур’єра” requests that are in the “Готово до виконання” status
     * and for which the time interval has not yet expired, i.e., they are active for adding Internet documents to them.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/d5efafc8-eabe-11ef-84e0-48df37b921da
     *
     * @param string $number
     * @return mixed API response.
     */
    public function getAvailableOrdersList($number){
        return $this->sendRequest("CarCallGeneral", "getAvailableOrdersList", ["Number" => $number]);
    }

    /**
     * This method allows you to cancel a “Courier Call” request.
     * If the request is canceled less than an hour before the end of the time interval and the customer has access to cashless payment,
     * a cancellation fee of 350 UAH will be charged.
     * Cancellation of an order is prohibited if the courier is at the sender's address and
     * has confirmed the number and weight of items in the order, or if the order status is “Виконано.”
     * To view the list of added Internet documents by the number of the “Виклик кур’єра” request, use the InternetDocument->getEWTemplateList() method.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/edfb5c7d-eab1-11ef-84e0-48df37b921da
     *
     *
     * @param string $ref Identifier (REF) of the created request for a courier call.
     * @return mixed
     */
    public function deleteCourierCall($ref){
        return $this->sendRequest("CarCallGeneral", "deleteCourierCall", ["Ref" => $ref]);
    }

    /**
     * This method allows you to update a courier request.
     * In this method, all parameters are required to be filled in, and after updating, only those that have been changed are replaced.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/ee1ff6d3-eab1-11ef-84e0-48df37b921da
     *
     * @param array<string, string> $data Required:
     * - Ref — Identifier (REF) of the created request for a courier call.
     * - PreferredDeliveryDate — Preferred delivery date (format: dd.mm.YYYY).
     * - PlanedWeight — Weight in kg.
     * - TimeInterval — Time interval (for ordering the “Time Intervals” service). To get list of available time intervals, use the Common->getPickupTimeIntervals() method.
     *
     * @return mixed API response.
     */
    public function updateCourierCall($data){
        $fields = array(
            "Ref" => "required",
            "PreferredDeliveryDate" => "required",
            "PlanedWeight" => "required",
            "TimeInterval" => "required",
        );

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("CarCallGeneral", "updateCourierCall", $methodProperties);
    }

    /**
     * This method allows you to remove Internet documents from the “Виклик кур’єра” request that do not need to be transferred to the courier as part of this request.
     * This method supports several options for deleting documents: one document at a time or in bulk.
     * The main part of the method is the same, only the number of documents being deleted differs.
     *
     * It is prohibited to delete Internet documents from the “Виклик кур’єра” request if:
     * - The request has one of the following statuses: “Виконано.”
     * - The courier is at the sender's address and has confirmed the number and weight of shipments in the request.
     *
     * To view the list of added Internet documents by the number of the “Виклик кур’єра” request, use the InternetDocument->getEWTemplateList() method.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/ee23f404-eab1-11ef-84e0-48df37b921da
     *
     * @param array<string> $linkedDocuments Internet documents(packages) that will be removed over to the courier as part of this application
     * @return mixed API Response.
     */
    public function removeDocuments($linkedDocuments){
        return $this->sendRequest("CarCallGeneral", "removeDocuments", ["Documents" => $linkedDocuments]);
    }


    /**
     * This method allows you to create a request for a courier to be sent from an address.
     * The method is only available to sender customers who have the “Виклик кур’єра” service connected upon request to a personal manager.
     * When you sign up for the “Виклик кур’єра” service, a setting is enabled that disables the automatic creation of requests based on the ID from the address.
     *
     * It is not possible to create a courier request if:
     *
     * - there is already a request created for the specified time interval from the same address and from the same CA
     * - the time interval has already passed or is unavailable for ordering.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/96141693-eaae-11ef-84e0-48df37b921da/method/ee2a2001-eab1-11ef-84e0-48df37b921da
     *
     * @param array<string, string> $data Required:
     * - ContactSenderRef — Identifier (REF) of the sender's contact person. You can take ref from Counterparty->getCounterpartyContactPersons() method.
     * - PreferredDeliveryDate — Preferred delivery date (format: dd.mm.YYYY).
     * - PlanedWeight — Weight in kg.
     * - TimeInterval — Time interval (for ordering the “Time Intervals” service). To get list of available time intervals, use the Common->getPickupTimeIntervals() method.
     * - CounterpartySender — Counterparty identifier (REF) sender
     * - AddressSenderRef — Identifier (REF) of the sender's address. You can get ref from the response of Address->createCounterpartyAddress()
     *
     * @return mixed ApiResponse.
     */
    public function createCourierCall($data){
        $fields = array([
            "ContactSenderRef" => "required",
            "PreferredDeliveryDate" => "required",
            "PlanedWeight" => "required",
            "TimeInterval" => "required",
            "CounterpartySender" => "required",
            "AddressSenderRef" => "required",
        ]);

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("CarCallGeneral", "saveCourierCall", $methodProperties);
    }
}