<?php
namespace payFURL\Sdk;

require_once(__DIR__ . "/tools/HttpWrapper.php");
require_once(__DIR__ . "/tools/ArrayTools.php");
require_once(__DIR__ . "/tools/UrlTools.php");

/*
 * (c) payFurl
 */
class PaymentMethod
{
    public function Checkout($Amount, $Currency, $Reference, $ProviderId, $Options)
    {
        $Data = [
            'providerId'     => $ProviderId,
            'amount'         => $Amount,
            'currency'       => $Currency,
            'reference'      => $Reference
        ];

        if ($Options != NULL)
        {
            foreach ($Options as $Key => $Value)
            {
                $Data[$Key] = $Value;
            }
        }
        
        $Data = ArrayTools::CleanEmpty($Data);

        print (json_encode($Data));

        return HttpWrapper::CallApi("/payment_method/checkout", "POST", json_encode($Data));
    }

    public function CustomerPaymentMethods($CustomerId)
    {
        $url = "/payment_method/customer/" . urlencode($CustomerId);

        return HttpWrapper::CallApi($url, "GET", "");
    }
}