<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Repositories\PaypalPaymentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PayPalController extends Controller
{
    /**
     * @var PaypalPaymentRepository
     */
    protected $repository;


    /**
     * @param PaypalPaymentRepository $repository
     */
    public function __construct(PaypalPaymentRepository $repository)
    {

        $this->repository = $repository;
    }

    public function createTransaction()
    {
        dd(\request()->all());
    }


    /**
     * success transaction.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function successTransaction(Request $request, $id): RedirectResponse
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            $toSave = [];
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                foreach ($request->get('ticket_type_id') as $key => $data) {
                    if ($request->get('seat')[$key] > 0) {
                        $toSave[] = [
                            'event_ticket_id' => $data,
                            'seat_quantity' => $request->get('seat')[$key],
                            'payer_id' => $request->get('PayerID'),
                            'token_id' => $request->get('token'),
                            'is_paid' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'phone' => $request->get('phone')
                        ];
                    }
                }
                Booking::insert($toSave);
                return redirect()
                    ->route('paymentReceived', ['id' => $id])
                    ->with('success', 'Thank You for the transaction.')
                    ->with('requestPayload', $toSave);
            } else {
                return redirect()
                    ->route('events.checkOut', $id)
                    ->with('error', $response['message'] ?? 'We are unable to do transaction on the moment.');
            }

        } catch (Throwable $exception) {
            Log::error($exception->getMessage());
            return redirect()
                ->route('events.checkOut', $id)
                ->with('error', 'Transaction cannot be processed on the moment.Please try again after a while.');
        }
    }

    /**
     * cancel transaction.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function cancelTransaction(Request $request): RedirectResponse
    {
        return redirect()
            ->route('events',)
            ->with('error', 'You have canceled the transaction.');
    }
}
