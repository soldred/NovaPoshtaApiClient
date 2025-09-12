<?php

namespace NovaPoshta\Models\PrintedForm;

class Registers extends BasePrintedForm
{
    /**
     * Generate URL to print a scan sheet (register).
     *
     * API Reference:
     * https://developers.novaposhta.ua/view/model/a3fe2fdd-8512-11ec-8ced-005056b2dbe1/method/a4347fc4-8512-11ec-8ced-005056b2dbe1
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
