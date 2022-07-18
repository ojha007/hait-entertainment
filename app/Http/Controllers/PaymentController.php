<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\PaypalPaymentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Throwable;

class PaymentController extends Controller
{
    /**
     * @var PaypalPaymentRepository
     */
    protected $paypalPaymentRepository;


    /**
     * @param PaypalPaymentRepository $paypalPaymentRepository
     */
    public function __construct(PaypalPaymentRepository $paypalPaymentRepository)
    {

        $this->paypalPaymentRepository = $paypalPaymentRepository;
    }

    public function paymentReceived(Request $request)
    {
        $session = $request->session()->get('requestPayload');
        if (isset($session) && count($session)) {
            $data = route('internal.bookings.checkIn', $session['0']['token_id']);
            $qrCode = QrCode::size(250)->generate($data);
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
        $requestPricing = $request->get('pricing') ?? [];
        $pricing = (new EventRepository(new Event()))->calculatePrice($id, $requestPricing);
        if ($pricing['total'] < 1) {
            return redirect()
                ->back()
                ->with('error', 'Amount should be greater than 0.');
        }
        if ($request->get('payment_method') === 'paypal') {
            $attributes = $request->except('_token','pricing');
            $attributes['event_id'] = $id;
            $attributes['id'] = $id;
            $attributes['amount'] = $pricing['total'];
            $response = $this->paypalPaymentRepository->pay($attributes);
            if (isset($response['id']) && $response['id'] != null) {
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('events.payment.received', $id)
                    ->with('success', 'Thank You for the transaction.')
                    ->with('payment', $response);

            } else {
                return redirect()
                    ->route('events.checkOut', $id)
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
        return redirect()->back();
    }
}
