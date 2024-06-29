<?php

namespace App\Models;

class Transaction {
    private $amount;
    private $currency;
    private $description;
    private $status;
    private $paymentIntentId;

    public function __construct(float $amount, string $currency, string $description) {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->status = 'pending';
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function getCurrency(): string {
        return $this->currency;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setPaymentIntentId(string $paymentIntentId): void {
        $this->paymentIntentId = $paymentIntentId;
    }

    public function getPaymentIntentId(): ?string {
        return $this->paymentIntentId ?? null;
    }
}
