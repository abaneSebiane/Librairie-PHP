<?php
namespace App;

require_once __DIR__ . '/vendor/autoload.php';

use App\Managers\PaymentManager;
use App\Services\StripePayment;

//Ajout et suppression d'interfaces de paiement prises en charge :
$paymentManager = new PaymentManager();
$paymentManager->addPaymentInterface("stripe", new StripePayment());
//$paymentManager->removePaymentInterface("stripe");

//Pouvoir sélectionner dynamiquement l'interface de paiement à utiliser
$stripePayment = $paymentManager->getPaymentInterface("stripe");

if ($stripePayment !== null) {
    try
    {
        // Initialisation d'une interface de paiement avec ses identifiants de connexion
        $stripePayment->initialize(['api_key' => 'sk_test_51PX6nWRv1OMvXsRITDD8oturLPyAenrdy6hArwzJWbWBdP6v0YWk7NQbeMfYsFvUB6RBpIkHF3EPWF78LVsLJJSa00SN2fDR4H']);

        // Création d'une transaction de paiement avec un montant, une devise et une description
        $transaction = $stripePayment->createTransaction(100.0, 'USD', 'Test Payement botan');

        // Exécution d'une transaction de paiement et récupération de son résultat (succès, échec, etc.).
        $result = $stripePayment->executeTransaction($transaction);
        echo $result->getMessage() . "<br>";
        //echo $result->isSuccess() . "<br>";
        echo "Résultat : " . $stripePayment->getStatus($transaction);

        // Annulation d'une transaction de paiement en cours.
        //$cancelResult = $stripePayment->cancelTransaction($transaction);
        //echo $cancelResult->getMessage() . "<br>";
        //echo $result->isSuccess() . "<br>";
        // echo "Résultat : " . $stripePayment->getStatus($transaction);

    }
    catch (\Exception $e)
    {
        echo 'Erreur : ' . $e->getMessage();
    }
}
else
{
    echo 'Interface de paiement non trouvé :(';
}


