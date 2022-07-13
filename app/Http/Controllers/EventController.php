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
            $eventAttributes = $request->only('title', 'event_type_id', 'description', 'address', 'date', 'time');
            DB::beginTransaction();
            $event = $this->repository->create($eventAttributes);

            $ticketTypeIds = $request->get('ticket_type_id');
            $rates = $request->get('rate');
            $this->repository->storeEventPricing($event, $ticketTypeIds, $rates);

            $removedIndex = $request->get('removed_index') ?? [];
            $files = $request->file('files');
            $toSaveFiles = $this->repository->prepareImageToSave($removedIndex, $files);
            $filesPath = $this->uploadFiles($toSaveFiles, 'events');
            $this->repository->saveImages($event, $filesPath);
            DB::commit();
            $message = successMessage('CREATED', 'Event');
            return redirect()
                ->route($this->routePath . 'show', $event->id)
                ->with('success', $message);
        } catch (Throwable $exception) {
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
        $event = $this->repository->getWith($id, ['images', 'pricing', 'eventType']);
        return view($this->viewPath . 'show', compact('event'));
    }

    public function edit($id)
    {

        $event = $this->repository->getWith($id, ['images', 'pricing', 'eventType']);
        $eventTypes = (new EventTypeRepository(new EventType()))->selectEventTypes();
        $tickets = (new TicketTypeRepository(new TicketType()))->selectTicketTypes();
        return view($this->viewPath . 'edit', compact('event', 'eventTypes', 'tickets'));
    }

}
