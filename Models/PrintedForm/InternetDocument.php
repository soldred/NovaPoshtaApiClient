<?php

namespace NovaPoshta\Models\PrintedForm;

require_once __DIR__ . "/BasePrintedForm.php";

class InternetDocument extends BasePrintedForm
{
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Generate URL to print InternetDocument (waybill/ЕН).
     *
     * @param string|array $refs Single ref or array of refs (UUID or EN numbers).
     * @param string $format Format type: self::FORMAT_PDF, self::FORMAT_PDF8 or self::FORMAT_HTML
     * @return string URL for printing.
     */
    public function getPrintUrl($refs, $format = self::FORMAT_PDF)
    {
        $orders = is_array($refs) ? implode(',', $refs) : $refs;
        $orders = urlencode($orders);

        return "https://my.novaposhta.ua/orders/printDocument/orders/{$orders}/type/{$format}/apiKey/{$this->apiKey}";
    }
}
