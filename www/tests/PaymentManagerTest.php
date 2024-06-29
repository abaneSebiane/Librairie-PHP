<?php

use PHPUnit\Framework\TestCase;
use App\Managers\PaymentManager;
use App\Services\StripePayment;

class PaymentManagerTest extends TestCase {
    public function testAddPaymentInterface() {
        $manager = new PaymentManager();
        $stripePayment = new StripePayment();
        $manager->addPaymentInterface('stripe', $stripePayment);

        $this->assertInstanceOf(StripePayment::class, $manager->getPaymentInterface('stripe'));
    }

    public function testRemovePaymentInterface() {
        $manager = new PaymentManager();
        $stripePayment = new StripePayment();
        $manager->addPaymentInterface('stripe', $stripePayment);
        $manager->removePaymentInterface('stripe');

        $this->assertNull($manager->getPaymentInterface('stripe'));
    }
}
