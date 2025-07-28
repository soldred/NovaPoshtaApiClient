<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

class Registers extends BaseModel
{

    /**
     * To transfer registered shipments, you must generate a corresponding request.
     * In response to the request to generate a register,
     * the register number and shipment numbers with the status “додано” or “не додано” to the register are returned.
     *
     * There are the following restrictions on working with registers:
     * - An Internet document (ID) can be added to the register
     * if the sender's details (city, counterparty, address) are identical for all shipments being added.
     *
     * - An ID can only be added to one register, i.e., the same document cannot be added to several registers at the same time.
     *
     * - An ID cannot be added to the register if a printed form has already been received for the document
     * and the date of dispatch (printing) is earlier than yesterday's date from the date of the register's creation.
     *
     * - An ID can be added to the register only until the moment of creating
     * an express waybill based on the ID (or scanning this shipment at a Nova Poshta branch/division).
     *
     * - An ID marked for deletion cannot be added to the register.
     *
     * - After receiving the printed form of the register, the addition of documents to it is blocked.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a482293c-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string, array|string> $data Required:
     * - DocumentRefs — Array of document identifiers (REF)
     * - Ref — Registry ID (REF), if you need to add a document to an existing registry
     * - Date — Specific register date (format: dd.mm.YYYY).
     *
     * @return mixed API response.
     */
    public function insertDocuments($data){
        $fields = array([
            "DocumentRefs" => "required",
            "Ref" => "required",
            "Date" => "required",
        ]);

        $methodProperties = $this->validateFields($fields, $data);

        return $this->sendRequest("ScanSheetGeneral", "insertDocuments", $methodProperties);
    }

    /**
     * To transfer registered shipments according to the Register,
     * the functionality of forming and deleting shipment acceptance and transfer registers is integrated.
     * When transferring shipments according to the Register, it is necessary to place a mark on each shipment and print two copies of the Register.
     *
     * API Referenence:
     * https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a4d93a89-8512-11ec-8ced-005056b2dbe1
     *
     * @return mixed API response.
     */
    public function getRegisters(){
        return $this->sendRequest("ScanSheetGeneral", "getScanSheet", new \stdClass());
    }

    /**
     * To transfer registered shipments according to the Register,
     * the functionality of forming and deleting shipment acceptance and transfer registers is integrated.
     * When transferring shipments according to the Register, it is necessary to place a mark on each shipment and print two copies of the Register.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a4abdd36-8512-11ec-8ced-005056b2dbe1
     *
     * @param string $ref Registry identifier (REF)
     * @param string $counterpartyRef Counterparty identifier (REF)
     *
     * @return mixed API response
     */
    public function getRegister($ref, $counterpartyRef){
        if(empty($ref) || empty($counterpartyRef)){
            throw new \InvalidArgumentException('Missing required parameter: $ref or $counterpartyRef.');
        }

        return $this->sendRequest("ScanSheetGeneral", "getScanSheet", ["Ref" => $ref, "CounterpartyRef" => $counterpartyRef]);
    }

    /**
     *After deleting the register, the register number is deleted from the Nova Poshta information system,
     * and the express waybills included in it are released but not deleted (the register is disbanded).
     * To delete the register, you must submit a corresponding request.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a50e049b-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string> $scanSheetRefs Array of registry identifiers (REF)
     *
     * @return mixed API response.
     */
    public function deleteRegister($scanSheetRefs){
        if(empty($ScanSheetRefs)){
            throw new \InvalidArgumentException('Missing required parameter: $scanSheetRefs.');
        }

        if(!is_array($ScanSheetRefs)){
            throw new \InvalidArgumentException('$scanSheetRefs must be an array.');
        }

        return $this->sendRequest("ScanSheetGeneral", "deleteScanSheet", ["$scanSheetRefs" => $ScanSheetRefs]);
    }

    /**
     * This method is designed to remove express waybills (EN) from the register in the Nova Poshta information system.
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a46fc4f4-8512-11ec-8ced-005056b2dbe1/method/a53dea8a-8512-11ec-8ced-005056b2dbe1
     *
     * @param array<string> $documentRefs Array of identifiers(REF) for documents that need to be deleted
     * @param string $ref Registry identifier (REF)
     *
     * @return mixed API response.
     */
    public function removeDocuments($documentRefs, $ref){
        if(empty($ref) || empty($documentRefs)){
            throw new \InvalidArgumentException('Missing required parameter: $ref or $documentRefs.');
        }

        if(!is_array($documentRefs)){
            throw new \InvalidArgumentException('$scanSheetRefs must be an array.');
        }

        return $this->sendRequest("ScanSheetGeneral", "removeDocuments", ["DocumentRefs" => $documentRefs, "Ref" => $ref]);
    }

}