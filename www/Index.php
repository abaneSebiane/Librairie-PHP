<?php
namespace App;

require_once __DIR__ . '/vendor/autoload.php';

use App\Managers\PaymentManager;
use App\Services\StripePayment;

$paymentManager = new PaymentManager();
$stripePayment = new StripePayment();

try
{
    $stripePayment->initialize(['api_key' => 'sk_test_51PX6nWRv1OMvXsRITDD8oturLPyAenrdy6hArwzJWbWBdP6v0YWk7NQbeMfYsFvUB6RBpIkHF3EPWF78LVsLJJSa00SN2fDR4H']);
    $transaction = $stripePayment->createTransaction(100.0, 'USD', 'Test Payement botan');
    $result = $stripePayment->executeTransaction($transaction);
    echo $result->getMessage();
    //Annulation OK
    //$cancelResult = $stripePayment->cancelTransaction($transaction);
    //echo $cancelResult->getMessage();
    
}
catch (\Stripe\Exception\ApiErrorException $e)
{
    echo 'Erreur Stripe : ' . $e->getMessage();
}
catch (\Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}
