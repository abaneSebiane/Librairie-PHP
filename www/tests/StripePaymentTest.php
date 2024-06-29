<?php

use PHPUnit\Framework\TestCase;
use App\Services\StripePayment;
use App\Models\Transaction;

class StripePaymentTest extends TestCase {
    private $stripePayment;

    protected function setUp(): void {
        $this->stripePayment = new StripePayment();
        $this->stripePayment->initialize(['api_key' => 'test_api_key']);
    }

    public function testCreateTransaction() {
        $transaction = $this->stripePayment->createTransaction(100.0, 'USD', 'Test Payment');
        $this->assertInstanceOf(Transaction::class, $transaction);
    }

    public function testExecuteTransaction() {
        $transaction = $this->stripePayment->createTransaction(100.0, 'USD', 'Test Payment');
        $result = $this->stripePayment->executeTransaction($transaction);

        $this->assertTrue($result->isSuccess());
    }

    public function testCancelTransaction() {
        $transaction = $this->stripePayment->createTransaction(100.0, 'USD', 'Test Payment');
        $result = $this->stripePayment->cancelTransaction($transaction);

        $this->assertTrue($result->isSuccess());
    }
}
