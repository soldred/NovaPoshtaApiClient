<?php
namespace NovaPoshta\Models\PrintedForm;

/**
 * A container class for accessing different types of printable documents.
 * It lazy-loads the specific document classes (InternetDocument, Marking, etc.) on demand.
 *
 * @property-read \NovaPoshta\Models\PrintedForm\InternetDocument $InternetDocument
 * @property-read \NovaPoshta\Models\PrintedForm\Marking $Marking
 * @property-read \NovaPoshta\Models\PrintedForm\Registers $Registers
 */
class PrintedForm {
    private $apiKey;

    /** @var array A cache for sub-model instances. */
    private $subModels = [];

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * Magic method to lazy-load the actual print model classes.
     */
    public function __get($name) {
        if (isset($this->subModels[$name])) {
            return $this->subModels[$name];
        }

        // The __NAMESPACE__ constant provides the current namespace ('NovaPoshta\Models\PrintedForm')
        $className = __NAMESPACE__ . '\\' . $name;

        if (class_exists($className)) {
            // Create the sub-model instance, passing the apiKey it needs.
            $modelInstance = new $className($this->apiKey);
            $this->subModels[$name] = $modelInstance;
            return $modelInstance;
        }

        throw new \Exception("Printed form sub-model '$name' not found.");
    }
}