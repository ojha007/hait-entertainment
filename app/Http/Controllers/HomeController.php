<?php

namespace App\Http\Controllers;

use App\Models\Carousal;
use App\Models\Event;
use App\Models\Partner;
use App\Repositories\CarousalRepository;
use App\Repositories\EventRepository;
use App\Repositories\PartnerRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $sliderImages = (new CarousalRepository(new Carousal()))->getImages(3);
        $events = (new EventRepository(new Event()))->getAllEvents();
        $partners = (new PartnerRepository(new Partner()))->getAll();
        return view('frontend.index', compact('sliderImages', 'events', 'partners'));
    }

    public function contactUs()
    {
        return view('frontend.contact');
    }

    public function events()
    {
        $repo = (new EventRepository(new Event()));
        $events = $repo->upcomingEvents(10);
        return view('frontend.events.index', compact('events'));
    }

    public function eventDetail($id)
    {
        $repo = (new EventRepository(new Event()));
        $event = $repo->getById($id);
        $upcomingEvents = $repo->upcomingEvents(5);
        return view('frontend.events.detail', compact('event', 'upcomingEvents'));
    }

    public function checkOut(Request $request, $id)
    {
        $months = [];
        $years = [];
        for ($i = date("m"); $i <= 12; $i++) {
            $months[$i] = strlen($i) < 2 ? "0" . $i : $i;
        }
        for ($i = date('Y'); $i <= date('Y') + 10; $i++) {
            $years[$i] = $i;
        }
        $repo = (new EventRepository(new Event()));
        $requestPricing = $request->get('pricing') ?? [];
        $data = $repo->calculatePrice($id, $requestPricing);
        $event = $data['event'];
        $total = $data['total'];
        if ($total < 1) {
            return redirect()
                ->back()
                ->with('error', 'Amount cannot be less than one.');
        }

        $paymentMethod = ['paypal' => 'Paypal', 'card' => 'Debit/Credit Card'];
        return view('frontend.events.checkout', compact('event', 'requestPricing', 'total', 'paymentMethod', 'months', 'years'));
    }


}
