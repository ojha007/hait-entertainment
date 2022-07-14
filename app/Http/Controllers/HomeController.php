<?php

namespace App\Http\Controllers;

use App\Models\Carousal;
use App\Models\Event;
use App\Repositories\CarousalRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Support\Renderable;

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
}
