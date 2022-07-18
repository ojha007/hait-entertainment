<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Event;
use App\Repositories\BookingRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Throwable;

class BookingController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'backend.bookings.';
    protected $repository;

    public function __construct(BookingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $eventRepo = (new EventRepository(new Event()));
        $eventId = $request->get('event_id');
        $events = $eventRepo->selectEvents();
        $event = null;
        $bookings = null;
        if ($eventId) {
            $bookings = $this->repository->findByEventId($eventId);
            $event = $eventRepo->getWith($eventId, 'pricing');
        }
        return view($this->viewPath . 'index', compact('bookings', 'events', 'event'));
    }

    public function store(BookingRequest $request)
    {
        try {
            $attributes = $request->validated();
        } catch (Throwable $exception) {

        }
    }

    public function checkIn($token)
    {
        $bookings = $this->repository->getBookingByToken($token);
    }
}

