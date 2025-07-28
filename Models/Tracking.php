<?php

namespace NovaPoshta\Models;

use NovaPoshta\BaseModel;

class Tracking extends BaseModel
{
    // Documents should be an array
    public function getStatusDocuments($documents){
        return $this->sendRequest("TrackingDocument", "getStatusDocuments", ["Documents" => $documents]);
    }
}