<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use App\Models\Event;
use App\Repositories\CardPaymentRepository;
use App\Repositories\EventRepository;
use App\Repositories\PaypalPaymentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Throwable;

class PaymentController extends Controller
{
    /**
     * @var PaypalPaymentRepository
     */
    protected $paypalPaymentRepository;
    /**
     * @var CardPaymentRepository
     */
    protected $cardPaymentRepository;


    /**
     * @param PaypalPaymentRepository $paypalPaymentRepository
     * @param CardPaymentRepository $cardPaymentRepository
     */
    public function __construct(PaypalPaymentRepository $paypalPaymentRepository, CardPaymentRepository $cardPaymentRepository)
    {

        $this->paypalPaymentRepository = $paypalPaymentRepository;
        $this->cardPaymentRepository = $cardPaymentRepository;
    }

    public function paymentReceived(Request $request)
    {
        $session = $request->session()->get('requestPayload');
        if (isset($session) && count($session)) {
            $data = route('internal.bookings.checkIn', $session[0]['token_id']);
            $qrCode = QrCode::size(250)->generate($data);
            if ($session[0]['email']) {
                Mail::to($session[0]['email'])->queue(new BookingConfirmed($session[0], $qrCode));
            }
            return view('frontend.payments.received', compact('qrCode'));
        } else {
            return view('frontend.payments.failed');
        }

    }

    /**
     * process transaction.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function processTransaction(Request $request, $id): RedirectResponse
    {
        try {
            $requestPricing = $request->get('pricing') ?? [];
            $pricing = (new EventRepository(new Event()))->calculatePrice($id, $requestPricing);
            if ($pricing['total'] < 1) {
                return redirect()
                    ->back()
                    ->with('error', 'Amount should be greater than 0.');
            }
            $attributes = $request->except('_token', 'pricing');
            $attributes['event_id'] = $id;
            $attributes['id'] = $id;
            $attributes['amount'] = $pricing['total'];

            if ($request->get('payment_method') === 'paypal') {
                $response = $this->paypalPaymentRepository->pay($attributes);
                if (isset($response['id']) && $response['id'] != null) {
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('paymentReceived', $id)
                        ->with('success', 'Thank You for the transaction.')
                        ->with('requestPayload', $response);
                }
            }

            if ($request->get('payment_method') === 'card') {
                $attributes['stripeToken'] = $request->get('stripeToken');
                $response = $this->cardPaymentRepository->pay($attributes);
                if ($response['success']) {
                    $attributes['token'] = $attributes['stripeToken'];
                    $attributes['PayerID'] = 00;
                    $toReturn = $this->cardPaymentRepository->successTransaction($attributes);
                    return redirect()
                        ->route('paymentReceived', $id)
                        ->with('success', 'Thank You for the transaction.')
                        ->with('requestPayload', $toReturn);
                }

            }
        } catch (Throwable $exception) {
            dd($exception, 'FF');
        }
        return redirect()
            ->route('events.show', $id)
            ->with('error', 'Unable to create a transaction.');
    }
}
