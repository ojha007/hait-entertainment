<?php

namespace App\Repositories;

use App\Abstracts\PaymentInterface;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentRepository implements PaymentInterface
{

    public function pay(array $attributes)
    {
        try {
            $provider = new PayPalClient();
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            return $provider->createOrder([
                "intent" => "CAPTURE",
                'requestPayload' => $attributes,
                "application_context" => [
                    "return_url" => route('successTransaction', $attributes),
                    "cancel_url" => route('cancelTransaction', ['id' => $attributes['event_id']]),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "AUD",
                            "value" => $attributes['amount']
                        ]
                    ]
                ]
            ]);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }

    }
}
