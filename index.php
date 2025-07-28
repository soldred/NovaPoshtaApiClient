<?php


require_once __DIR__ . '/NovaPoshtaApiClient.php';

use NovaPoshta\NovaPoshtaClient;

$apiKey = getenv('apiKey');
$np = new NovaPoshtaClient($apiKey);

$result = $np->Address->getCities([
    'FindByString' => 'Кривий Ріг',
]);


//$result = $np->Address->getCities();

//$result = $np->Address->getWarehouseTypes();

//$result = $np->Address->getWarehouses([
//    "TypeOfWarehouseRef" => "f9316480-5f2d-425d-bc2c-ac7cd29decf0",
//    "CityRef" => "db5c890d-391c-11dd-90d9-001a92567626"
//]);

//$result = $np->Address->getWarehouses([
//    "TypeOfWarehouseRef" => "f9316480-5f2d-425d-bc2c-ac7cd29decf0",
//    "CityRef" => $np->Address->getCities([
//        'FindByString' => 'Кривий Ріг'
//    ])->data[0]->Ref
//]);

//$result = $np->Address->getStreet(["CityRef" => "db5c890d-391c-11dd-90d9-001a92567626", "FindByString" => "Лісо"]);


//$counterparty = $np->Counterparty;
//$result = $counterparty->createCounterparty([
//    "FirstName" => "Іван",
//    "MiddleName" => "Іванович",
//    "LastName" => "Тестовий",
//    "Phone" => "380501112233",
//    "Email" => "test@example.com",
//], $counterparty::TYPE_PRIVATE_PERSON, $counterparty::PROPERTY_RECIPIENT);

//$result = $np->Counterparty->deleteCounterparty("6d712ae3-6ab0-11ea-8513-b88303659df5"); // DOES NOT WORK ON PRIVATE PERSON

//$result = $np->Counterparty->getCounterpartyContactPersons("6d712ae3-6ab0-11ea-8513-b88303659df5");

//$result = $np->Address->createCounterpartyAddress([
//    "CounterpartyRef" => "6d712ae3-6ab0-11ea-8513-b88303659df5",
//    "StreetRef" => "ce811d0e-4156-11dd-9198-001d60451983",
//    "BuildingNumber" => "34",
//    "FlatNumber" => "22",
//    "Notes" => "psycho dad"
//]);

//$result = $np->Common->getCargoTypes();
//$result = $np->Common->getMessageCodeText();
//$result = $np->Common->getPalletsList();

//
//$result = $np->InternetDocument->getDocumentList([
//    "DateTimeFrom" => "20.07.2025",
//    "DateTimeTo" => "28.07.2025",
//    "GetFullList" => "1"
//]);

//echo \NovaPoshta\Models\PrintedForm\Marking::FORMAT_PDF8;
header('Content-type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
