<?php

namespace App\Models;

class TransactionResult {
    private $success;
    private $message;

    public function __construct(bool $success, string $message) {
        $this->success = $success;
        $this->message = $message;
    }

    public function isSuccess(): bool {
        return $this->success;
    }

    public function getMessage(): string {
        return $this->message;
    }
}
