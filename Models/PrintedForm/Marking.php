<?php

namespace NovaPoshta\Models\PrintedForm;

require_once __DIR__ . "/BasePrintedForm.php";

class Marking extends BasePrintedForm
{
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Generate URL to print marking documents.
     *
     * @param string|array $refs Single ref or array of refs (UUID or EN numbers).
     * @param string $size Size of the marking, e.g. '85x85' or '100x100'. Default '85x85'.
     * @param string $format Format type: self::FORMAT_PDF, self::FORMAT_PDF8 or self::FORMAT_HTML
     * @param bool $zebra Whether to use Zebra printer format.
     * @return string URL for printing.
     */
    public function getPrintUrl($refs, $size = self::SIZE_85x85, $format = self::FORMAT_PDF8, $zebra = false)
    {
        $orders = is_array($refs) ? implode(',', $refs) : $refs;
        $orders = urlencode($orders);

        $url = "https://my.novaposhta.ua/orders/printMarking/{$size}/orders/{$orders}/type/{$format}/apiKey/{$this->apiKey}";

        if ($zebra) {
            $url .= '/zebra';
        }

        return $url;
    }
}
