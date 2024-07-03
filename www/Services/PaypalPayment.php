<?php

namespace App\Services;

use App\Contracts\PaymentInterface;
use App\Models\Transaction;
use App\Models\TransactionResult;
use Stripe\Stripe;
use Stripe\PaymentIntent;

//Mettre le code pour Paypal ici (flemme)
class PaypalPayment implements PaymentInterface {
    private $apiKey;

    public function initialize(array $config): void {

    }

    public function createTransaction(float $amount, string $currency, string $description): Transaction {

    }

    public function executeTransaction(Transaction $transaction): TransactionResult {

    }

    public function cancelTransaction(Transaction $transaction): TransactionResult {

    }

    public function getStatus(Transaction $transaction): string {

    }
}
