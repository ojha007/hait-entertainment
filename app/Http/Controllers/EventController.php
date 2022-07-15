<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventType;
use App\Models\TicketType;
use App\Repositories\EventRepository;
use App\Repositories\EventTypeRepository;
use App\Repositories\TicketTypeRepository;
use App\Traits\FileUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventController extends Controller
{

    use FileUploader;

    protected $viewPath = 'backend.events.';
    protected $routePath = 'internal.events.';

    protected $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;

    }

    public function index()
    {
        $events = $this->repository->getAllEvents();
        return view($this->viewPath . 'index', compact('events'));
    }

    public function create()
    {
        $eventTypes = (new EventTypeRepository(new EventType()))->selectEventTypes();
        $tickets = (new TicketTypeRepository(new TicketType()))->selectTicketTypes();
        return view($this->viewPath . 'create', compact('eventTypes', 'tickets'));
    }

    /**
     * @param EventRequest $request
     * @return RedirectResponse
     */
    public function store(EventRequest $request): RedirectResponse
    {
        try {
            $attributes = $request->only('title', 'event_type_id', 'description', 'address', 'date', 'time', 'organizer');
            DB::beginTransaction();
            $attributes['image'] = $this->uploadFile($request->file('image'), 'events');
            $event = $this->repository->create($attributes);

            $ticketTypeIds = $request->get('ticket_type_id');
            $rates = $request->get('rate');
            $seats = $request->get('seat');
            if (count(array_filter($ticketTypeIds)) > 0)
                $this->repository->storeEventPricing($event, $ticketTypeIds, $rates, $seats);
            DB::commit();
            $message = successMessage('CREATED', 'Event');
            return redirect()
                ->route($this->routePath . 'show', $event->id)
                ->with('success', $message);
        } catch (Throwable $exception) {
//            dd($exception);
            DB::rollBack();
            $message = errorMessage('CREATE', 'Event');
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }
    }

    public function show($id)
    {
        $event = $this->repository->getWith($id, ['pricing', 'eventType']);
        return view($this->viewPath . 'show', compact('event'));
    }

    public function edit($id)
    {
        $event = $this->repository->getWith($id, ['pricing', 'eventType']);
        $eventTypes = (new EventTypeRepository(new EventType()))->selectEventTypes();
        $tickets = (new TicketTypeRepository(new TicketType()))->selectTicketTypes();
        return view($this->viewPath . 'edit', compact('event', 'eventTypes', 'tickets'));
    }


    public function update(EventRequest $request, $id): RedirectResponse
    {

        try {
            DB::beginTransaction();
            $attributes = $request->only('title', 'event_type_id', 'description', 'address', 'date', 'time', 'organizer');
            if ($request->has('image'))
                $attributes['image'] = $this->uploadFile($request->file('image'), 'events');
            $event = $this->repository->update($id, $attributes);
            $event->pricing()->delete();
            $ticketTypeIds = $request->get('ticket_type_id');
            $rates = $request->get('rate');
            $seats = $request->get('seat');
            $this->repository->storeEventPricing($event, $ticketTypeIds, $rates, $seats);
            DB::commit();
            $message = successMessage('UPDATED', 'Event');
            return redirect()
                ->route($this->routePath . 'show', $event->id)
                ->with('success', $message);
        } catch (Throwable $exception) {
            DB::rollBack();
            $message = errorMessage('UPDATE', 'Event');
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }
    }

}
