<?php

require_once __DIR__ . '/vendor/autoload.php';

use NovaPoshta\NovaPoshtaApiClient;
use NovaPoshta\Models\Counterparty;
use NovaPoshta\Models\PrintedForm\PrintedForm;

$apiKey = 'YOUR_API_KEY';

$np = new NovaPoshtaApiClient($apiKey);

//$result = $np->Address->getCities();

$result = $np->Counterparty->createCounterparty([
    "FirstName" => "Петро",
    "MiddleName" => "Тестович",
    "LastName" => "Отримуваченко",
    "Phone" => "380790533660",
    "email" => "testrecipientpetro@test.com"
],
    Counterparty::TYPE_PRIVATE_PERSON,
    Counterparty::PROPERTY_RECIPIENT
);

if (!is_null($result)) {
    header('Content-type: application/json');
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
} else {
    echo "No test case was uncommented in index.php";
}