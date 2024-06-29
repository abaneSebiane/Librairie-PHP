<?php

namespace App\Services;

use App\Contracts\PaymentInterface;
use App\Models\Transaction;
use App\Models\TransactionResult;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripePayment implements PaymentInterface {
    private $apiKey;

    public function initialize(array $config): void {
        $this->apiKey = $config['api_key'];
        Stripe::setApiKey($this->apiKey);
    }

    public function createTransaction(float $amount, string $currency, string $description): Transaction {
        return new Transaction($amount, $currency, $description);
    }

    public function executeTransaction(Transaction $transaction): TransactionResult {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $transaction->getAmount() * 100, // Montant en cents
                'currency' => $transaction->getCurrency(),
                'description' => $transaction->getDescription(),
            ]);

            $transaction->setStatus('succeeded');
            // Stocker l'ID du Payment Intent dans la transaction
            $transaction->setPaymentIntentId($paymentIntent->id);

            return new TransactionResult(true, 'Paiement réussi avec l\'ID : ' . $paymentIntent->id);
        } catch (\Exception $e) {
            $transaction->setStatus('failed');
            return new TransactionResult(false, 'Paiement échoué : ' . $e->getMessage());
        }
    }

    public function cancelTransaction(Transaction $transaction): TransactionResult {
        try {
            $paymentIntentId = $transaction->getPaymentIntentId();
            if (!$paymentIntentId) {
                throw new \Exception('ID de paiement manquant dans la transaction');
            }
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            $paymentIntent->cancel();
            $transaction->setStatus('canceled');

            return new TransactionResult(true, 'Paiement annulé avec succès');
        } catch (\Exception $e) {
            return new TransactionResult(false, 'Échec de l\'annulation : ' . $e->getMessage());
        }
    }

    public function getStatus(Transaction $transaction): string {
        return $transaction->getStatus();
    }
}
