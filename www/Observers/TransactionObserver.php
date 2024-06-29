<?php

namespace App\Observers;

class TransactionObserver {
    public function update($transaction, $status): void {
        echo "Statut de la transaction mis à jour à : $status";
    }
}
