<?php


require_once __DIR__ . '/NovaPoshtaApiClient.php';

use NovaPoshta\NovaPoshtaClient;

$apiKey = getenv('apiKey');
$np = new NovaPoshtaClient($apiKey);

/* YOU CAN FIND RESULTS IN THE TEXT.TXT FILE */

// ----- ADDRESS MODEL -----
//$result = $np->Address->getCities();
//$result = $np->Address->getCities(["FindByString"=>"Кр"]);
//$result = $np->Address->getCities(["FindByString"=>"Київ"]);
//$result = $np->Address->getWarehouseTypes();
//$result = $np->Address->getWarehouses(["CityName"=>"Кривий Ріг", "TypeOfWarehouseRef"=>"841339c7-591a-42e2-8233-7a0a00f0ed6f"]);
//$result = $np->Address->getWarehouses(["CityName" => "Київ", "TypeOfWarehouseRef"=>"f9316480-5f2d-425d-bc2c-ac7cd29decf0"]);
//$result = $np->Address->getStreet("", ""); // WILL THROW AN ERROR
//$result = $np->Address->getStreet("db5c890d-391c-11dd-90d9-001a92567626");

//$result = $np->Address->createCounterpartyAddress(); // NOT TESTED YET
//$result = $np->Address->deleteCounterpartyAddress(); // NOT TESTED YET
//$result = $np->Address->updateCounterpartyAddress(); // NOT TESTED YET


// ----- COUNTERPARTY MODEL -----

//$result = $np->Counterparty->createCounterparty([
//    "FirstName" => "Петро",
//    "MiddleName" => "Тестович",
//    "LastName" => "Отримуваченко",
//    "Phone" => "380790533660",
//    "email" => "testrecipientpetro@test.com"
//],
//    \NovaPoshta\Models\Counterparty::TYPE_PRIVATE_PERSON,
//    \NovaPoshta\Models\Counterparty::PROPERTY_RECIPIENT
//);

//$result = $np->Counterparty->createCounterparty([
//    "FirstName" => "Степан",
//    "MiddleName" => "Петрович",
//    "LastName" => "Отримуваченко",
//    "Phone" => "380711112439",
//    "email" => "testrecipientstepan@test.com"
//],
//    \NovaPoshta\Models\Counterparty::TYPE_PRIVATE_PERSON,
//    \NovaPoshta\Models\Counterparty::PROPERTY_RECIPIENT
//);

//$result = $np->Counterparty->getCounterparties([
//   "CounterpartyProperty" => \NovaPoshta\Models\Counterparty::PROPERTY_RECIPIENT
//]);

// UNCOMMENT THIS TO TEST NEXT METHODS
//$counterPartyRef = $np->Counterparty->getCounterparties([
//        "CounterpartyProperty" => \NovaPoshta\Models\Counterparty::PROPERTY_RECIPIENT
//    ])->data[0]->Ref;

//$result = $np->Counterparty->getCounterpartyContactPersons($counterPartyRef);
//$result = $np->Counterparty->getCounterpartyOptions($counterPartyRef);
//$result = $np->Counterparty->getCounterpartyAddresses($counterPartyRef, \NovaPoshta\Models\Counterparty::PROPERTY_RECIPIENT);
//$result = $np->Counterparty->deleteCounterparty($counterPartyRef); // PRIVATE PERSON CAN'T BE DELETED

//$result = $np->Address->createCounterpartyAddress([
//    "CounterpartyRef" => $counterPartyRef,
//    "StreetRef" => "bf713d7a-79c6-11e1-8934-0026b97ed48a", // Random street in Kryvyi Rih
//    "BuildingNumber" => "22",
//    "FlatNumber" => "7",
//    "Notes" => "Cool"
//]);


//----- CONTACT PERSON -----
//$result = $np->ContactPerson->createContactPerson([
//    "CounterpartyRef" => $counterPartyRef,
//    "FirstName" => "Олек",
//    "MiddleName" => "Олекович",
//    "LastName" => "Олекниченко",
//    "Phone" => "380790976449"
//]);

//$result = $np->ContactPerson->updateContactPerson([
//    "CounterpartyRef" => $counterPartyRef,
//    "Ref" => "e8d537f7-6c68-11f0-a1d5-48df37b921da", // createContactPerson returns this, or in Counterparties->getCounterpartyContactPersons($counterParty)
//    "FirstName" => "Акакій",
//    "MiddleName" => "Акакійович",
//    "LastName" => "Акакієнко",
//    "Phone" => "380790976448"
//]);

//$result = $np->ContactPerson->deleteContactPerson("e8d537f7-6c68-11f0-a1d5-48df37b921da");

// ----- COMMON MODEL -----
//$result = $np->getTimeIntervals(); // NOT TESTED, RecipientCityRef REQUIRED

//$result = $np->Common->getCargoTypes();
//$result = $np->Common->getMessageCodeText();
//$result = $np->Common->getPalletsList();
//$result = $np->Common->getBackwardDeliveryCargoTypes();
//$result = $np->Common->getTypesOfPayersForRedelivery();
//$result = $np->Common->getPackList();
//$result = $np->Common->getTiresWheelsList();
//$result = $np->Common->getCargoDescriptionList();
//$result = $np->Common->getMessageCodeText();
//$result = $np->Common->getServiceTypes();
//$result = $np->Common->getOwnershipFormsList();
//$result = $np->Common->getPickupTimeIntervals($senderCityRef, $dateTime);  // NOT TESTED


//
//$result = $np->InternetDocument->getDocumentList([
//    "DateTimeFrom" => "13.07.2025",
//    "DateTimeTo" => "29.07.2025",
//    "GetFullList" => "1",
//]);

//$result = $np->Tracking->getStatusDocuments([
//    [
//        "DocumentNumber" => "20451213058495",
//        "Phone" => "380987970536"
//    ],
//    [
//        "DocumentNumber" => "20451212119000",
//        "Phone" => "380987970536"
//    ],
//]);

// 20451213058495

//$result = $np->Counterparty->getCounterparties([
//    "CounterpartyProperty" => \NovaPoshta\Models\Counterparty::PROPERTY_RECIPIENT
//]);

//$result = $np->Counterparty->getCounterpartyContactPersons("6d52aeb3-6ab0-11ea-8513-b88303659df5"); // SENDER, тобто я

//$result = $np->Counterparty->getCounterpartyContactPersons("6d712ae3-6ab0-11ea-8513-b88303659df5"); // RECIPIENT, тобто отримувач якийсь

// 3736f1b7-6c60-11f0-a1d5-48df37b921da ОТРИМУВАЧЕНКО ПЕТРО ТЕСТОВИЧ

$result = $np->InternetDocument->createEW([
    "PayerType" => "Recipient",
    "PaymentMethod" => "Cash",
    "CargoType" => "Cargo",
    "ServiceType" => "WarehouseWarehouse",
    "SeatsAmount" => "1",
    "Description" => "Дуже велика книга",
    "Cost" => "3000",
    "CitySender" => "db5c890d-391c-11dd-90d9-001a92567626",
    "Sender" => "6d52aeb3-6ab0-11ea-8513-b88303659df5",
    "ContactSender" => "6d738ec3-6ab0-11ea-8513-b88303659df5",
    "SendersPhone" => "+380677479404",
    "SenderAddress" => "644de30b-e1c2-11e3-8c4a-0050568002cf",
    "CityRecipient" => "8d5a980d-391c-11dd-90d9-001a92567626",
    "Recipient" => "6d712ae3-6ab0-11ea-8513-b88303659df5",
    "ContactRecipient" => "3736f1b7-6c60-11f0-a1d5-48df37b921da",
    "RecipientsPhone" => "+380677479404",
    "RecipientAddress" => "34624c89-50ef-11f0-9ad7-d4f5ef0df2b8",
    "Weight" => "20",
    "OptionsSeat" => [
        [
            "volumetricWidth" => "30",          // см
            "volumetricLength" => "30",         // см
            "volumetricHeight" => "30",         // см
            "weight" => "20",                   // кг
        ]
    ],
    "BackwardDeliveryData" => [
        [
            "PayerType" => "Recipient",    // хто платить за зворотну доставку
            "CargoType" => "Money",
            "RedeliveryString" => "6000" // сума товару(умовно)
        ]
    ],
]);

//echo \NovaPoshta\Models\PrintedForm\Marking::FORMAT_PDF8;
header('Content-type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
