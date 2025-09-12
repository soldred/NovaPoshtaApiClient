<?php
namespace NovaPoshta;

/**
 * NovaPoshta API Client
 *
 * NOTE: This api was designed for PHP 5.6 and higher, but might work on older versions
 *
 * Official API Documentation  https://developers.novaposhta.ua/documentation
 *
 * @property-read \NovaPoshta\Models\Address $Address
 * @property-read \NovaPoshta\Models\Common $Common
 * @property-read \NovaPoshta\Models\ContactPerson $ContactPerson
 * @property-read \NovaPoshta\Models\Counterparty $Counterparty
 * @property-read \NovaPoshta\Models\Courier $Courier
 * @property-read \NovaPoshta\Models\InternetDocument $InternetDocument
 * @property-read \NovaPoshta\Models\Tracking $Tracking
 * @property-read \NovaPoshta\Models\PrintedForm\PrintedForm $PrintedForm
 * @property-read \NovaPoshta\Models\Registers $Registers
 */
class NovaPoshtaApiClient {
    private $apiKey;
    private $apiUrl = "https://api.novaposhta.ua/v2.0/json/";

    /**
     * @var array A cache for model instances to avoid creating them multiple times.
     */
    private $models = [];

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * Magic method to lazy-load API models.
     * It intelligently decides what to pass to the model's constructor.
     *
     * @param string $name The name of the model property (e.g., 'Address').
     * @return object
     * @throws \Exception
     */
    public function __get($name) {
        if (isset($this->models[$name])) {
            return $this->models[$name];
        }

        $className = 'NovaPoshta\\Models\\' . $name;

        // Handle special case for the PrintedForm container, which is in a subdirectory.
        if ($name === 'PrintedForm') {
            $className = 'NovaPoshta\\src\\Models\\PrintedForm\\PrintedForm';
        }

        if (class_exists($className)) {
            $modelInstance = null;
            // Check if the requested model is a special case (for printing).
            if ($name === 'PrintedForm') {
                // If so, pass only the API key string to its constructor.
                $modelInstance = new $className($this->apiKey);
            } else {
                // For all regular models, pass the entire client object.
                $modelInstance = new $className($this);
            }

            $this->models[$name] = $modelInstance;
            return $modelInstance;
        }

        throw new \Exception("Model or property '$name' not found.");
    }

    /**
     * Sends a request to the Nova Poshta API.
     * This is now the central method for all API calls.
     */
    public function sendRequest($model, $method, $properties = []) {
        $requestData = [
            "apiKey" => $this->apiKey,
            "modelName" => $model,
            "calledMethod" => $method,
            "methodProperties" => empty($properties) ? new \stdClass() : $properties,
        ];
        $curl = curl_init($this->apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}