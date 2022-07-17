<?php

namespace App\Http\Controllers;

use App\Models\Carousal;
use App\Models\Event;
use App\Repositories\CarousalRepository;
use App\Repositories\EventRepository;
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
        return view('frontend.index', compact('sliderImages', 'events'));
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
        $repo = (new EventRepository(new Event()));
        $event = $repo->getWith($id, 'pricing', 'pricing.ticket');
        $requestPricing = $request->get('pricing') ?? [];
        $total = 0;
        foreach ($event->pricing as $pricing) {
            if (array_key_exists($pricing->id, $requestPricing)) {
                $total += $pricing->rate * $requestPricing[$pricing->id];
            }
        }
        return view('frontend.events.checkout', compact('event', 'requestPricing', 'total'));
    }
}
