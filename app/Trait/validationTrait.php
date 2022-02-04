<?php 

namespace  App\Trait;

trait validationTrait {

    public function validateResult($message,$payload) {
        return [
            'message' => $message,
            'payload' => $payload
        ];
    }

}