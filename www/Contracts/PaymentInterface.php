<?php

namespace App\Contracts;

use App\Models\Transaction;
use App\Models\TransactionResult;

interface PaymentInterface {
    public function initialize(array $config): void;
    public function createTransaction(float $amount, string $currency, string $description): Transaction;
    public function executeTransaction(Transaction $transaction): TransactionResult;
    public function cancelTransaction(Transaction $transaction): TransactionResult;
    public function getStatus(Transaction $transaction): string;
}
