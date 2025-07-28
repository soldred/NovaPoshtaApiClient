<?php
namespace NovaPoshta\Models\PrintedForm;

require_once __DIR__ . '/InternetDocument.php';
require_once __DIR__ . '/Marking.php';
require_once __DIR__ . '/Registers.php';

class PrintedForm {
    private $apiKey;
    public $InternetDocument;
    public $Marking;
    public $Registers;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;

        $this->InternetDocument = new InternetDocument($apiKey);
        $this->Marking = new Marking($apiKey);
        $this->Registers = new Registers($apiKey);
    }
}