<?php 

namespace  App\Traits;

trait validationTrait {

    static function validateResult($message,$payload = []) {
        return [
            'message' => $message,
            'payload' => $payload
        ];
    }

}