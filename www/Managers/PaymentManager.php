<?php

namespace App\Managers;

use App\Contracts\PaymentInterface;

class PaymentManager {
    private $paymentInterfaces = [];

    public function addPaymentInterface(string $name, PaymentInterface $paymentInterface): void {
        $this->paymentInterfaces[$name] = $paymentInterface;
    }

    public function removePaymentInterface(string $name): void {
        unset($this->paymentInterfaces[$name]);
    }

    public function getPaymentInterface(string $name): ?PaymentInterface {
        return $this->paymentInterfaces[$name] ?? null;
    }
}
