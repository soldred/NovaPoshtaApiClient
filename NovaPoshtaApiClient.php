<?php
namespace NovaPoshta;

require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/Models/Address.php';
require_once __DIR__ . '/Models/Common.php';
require_once __DIR__ . '/Models/ContactPerson.php';
require_once __DIR__ . '/Models/Counterparty.php';
require_once __DIR__ . '/Models/Courier.php';
require_once __DIR__ . '/Models/InternetDocument.php';
require_once __DIR__ . '/Models/Tracking.php';
require_once __DIR__ . '/Models/PrintedForm/PrintedForm.php';

use NovaPoshta\Models\Address;
use NovaPoshta\Models\Common;
use NovaPoshta\Models\ContactPerson;
use NovaPoshta\Models\Counterparty;
use NovaPoshta\Models\Courier;
use NovaPoshta\Models\InternetDocument;
use NovaPoshta\Models\PrintedForm\PrintedForm;
use NovaPoshta\Models\Tracking;

/**
 * NovaPoshta API Client
 *
 * NOTE: This api was designed for PHP 5.6 and higher, but might work on older versions
 *
 * Official API Documentation  https://developers.novaposhta.ua/documentation
 *
 */

class NovaPoshtaClient {
    private $apiKey;
    private $apiUrl = "https://api.novaposhta.ua/v2.0/json/";

    public $Address;
    public $Common;
    public $ContactPerson;
    public $Counterparty;
    public $Courier;
    public $InternetDocument;
    public $Tracking;
    public $PrintedForm;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;

        $this->Address = new Address($apiKey, $this->apiUrl);
        $this->Common = new Common($apiKey, $this->apiUrl);
        $this->ContactPerson = new ContactPerson($apiKey, $this->apiUrl);
        $this->Counterparty = new Counterparty($apiKey, $this->apiUrl);
        $this->Courier = new Courier($apiKey, $this->apiUrl);
        $this->InternetDocument = new InternetDocument($apiKey, $this->apiUrl);
        $this->Tracking = new Tracking($apiKey, $this->apiUrl);
        $this->PrintedForm = new PrintedForm($apiKey);

    }
}