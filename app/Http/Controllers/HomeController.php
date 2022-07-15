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

    }

    public function eventDetail($id)
    {
        $repo = (new EventRepository(new Event()));
        $event = $repo->getById($id);
        $upcomingEvents = $repo->upcomingEvents(5);
        return view('frontend.events.detail', compact('event', 'upcomingEvents'));
    }

    public function buyTicket(Request $request, $id)
    {
        $repo = (new EventRepository(new Event()));
        $event = $repo->getById($id);
        $bookings = $request->get('bookings');
        return view('frontend.events.buy-ticket', compact('event', 'bookings'));
    }
}
