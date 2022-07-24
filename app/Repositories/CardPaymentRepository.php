<?php

namespace App\Repositories;

use App\Abstracts\PaymentInterface;
use App\Models\Booking;
use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Stripe;
use Throwable;

class CardPaymentRepository implements PaymentInterface
{

    /**
     * @throws Exception
     */
    public function pay(array $attributes): array
    {

        try {
            $event = Event::find($attributes['id']);
            Stripe::setApiKey(config('services.stripe.secret'));
            $payload = Charge::create([
                'receipt_email' => $attributes['email'],
                'amount' => $attributes['amount'] * 100,
                'currency' => 'aud',
                'card' => $attributes['stripeToken'],
                'metadata' => [
                    'Name' => $attributes['name'],
                    'Email' => $attributes['email'],
                    'Phone' => $attributes['phone']
                ],
                'description' => $event->title
            ]);
            return [
                'success' => true,
                'payload' => $payload
            ];

        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw  new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }


    /**
     * @throws Exception
     */
    public function successTransaction(array $attributes): array
    {
        try {
            $toSave = [];
            foreach ($attributes['ticket_type_id'] as $key => $data) {
                if ($attributes['seat'][$key] > 0) {
                    $toSave[] = [
                        'event_ticket_id' => $data,
                        'seat_quantity' => $attributes['seat'][$key],
                        'payer_id' => $attributes['PayerID'],
                        'token_id' => $attributes['token'],
                        'is_paid' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'name' => $attributes['name'],
                        'email' => $attributes['email'],
                        'phone' => $attributes['phone']
                    ];
                }
            }
            Booking::insert($toSave);
            return $toSave;
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
