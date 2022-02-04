<?php 

namespace  App\Trait;

trait validationTrait {

    static function validateResult($message,$payload = []) {
        return [
            'message' => $message,
            'payload' => $payload
        ];
    }

}