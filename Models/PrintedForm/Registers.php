<?php

namespace NovaPoshta\Models\PrintedForm;

require_once __DIR__ . "/BasePrintedForm.php";

class Registers extends BasePrintedForm
{
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Generate URL to print a scan sheet (register).
     *
     * @param string $ref Register Ref or number (UUID or numeric code)
     * @param string $format Format type: self::FORMAT_PDF or self::FORMAT_HTML
     * @return string URL for printing.
     */
    public function getPrintUrl($ref, $format = self::FORMAT_PDF)
    {
        $ref = urlencode($ref);

        return "https://my.novaposhta.ua/scanSheet/printScanSheet/refs[]/{$ref}/type/{$format}/apiKey/{$this->apiKey}";
    }
}
