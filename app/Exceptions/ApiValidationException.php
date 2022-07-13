<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use RuntimeException;

class ApiValidationException extends RuntimeException
{
    public $original;
    protected $message, $errors, $status;

    /**
     * @param $message
     * @param $errors
     * @param $status
     */
    public function __construct($message, $errors, $status)
    {
        $this->message = $message;
        $this->errors = $errors;
        $this->status = $status;
        $this->original = ['message' => $message, 'errors' => $errors];
    }

    /**
     * @return array
     */
    public function report(): array
    {
        return [
            'message' => $this->message,
            'errors' => $this->errors,
            'success' => false,
            'status' => $this->status
        ];
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'success' => false,
            'status' => $this->status,
            'errors' => $this->errors
        ], $this->status);
    }

    public function getStatusCode()
    {
        return $this->status;
    }

}
