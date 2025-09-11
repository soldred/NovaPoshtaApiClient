<?php
namespace NovaPoshta\Models\PrintedForm;

/**
 * Base class for print models, containing shared constants and logic.
 */
abstract class BasePrintedForm
{
    const SIZE_85x85 = '85x85';
    const SIZE_100x100 = '100x100';

    const FORMAT_PDF = 'pdf';
    const FORMAT_PDF8 = 'pdf8';
    const FORMAT_HTML = 'html';

    protected $apiKey;

    public function __construct($apiKey){
        $this->apiKey = $apiKey;
    }
}