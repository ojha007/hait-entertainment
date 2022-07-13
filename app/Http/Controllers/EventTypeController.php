<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventTypeRequest;
use App\Repositories\EventTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Throwable;

class EventTypeController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'backend.event-types.';

    protected $repository;

    public function __construct(EventTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $eventTypes = $this->repository->getAll();
        return view($this->viewPath . 'index', compact('eventTypes'));

    }

    /**
     * @param EventTypeRequest $request
     * @return JsonResponse
     */
    public function store(EventTypeRequest $request): JsonResponse
    {
        try {
            $attributes = $request->validated();
            $this->repository->create($attributes);
            $message = successMessage('CREATED', 'Event Type');
            $request->session()->flash('success', $message);
            return new JsonResponse(['status' => 200, 'data' => []], 201);
        } catch (Throwable $exception) {
            $message = errorMessage('CREATE', 'Event Type');
            $request->session()->flash('failed', $message);
            return new JsonResponse(['status' => 500, 'data' => []], 500);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->repository->delete($id);
        $message = successMessage('DELETED', 'Event Type');
        return redirect()
            ->back()
            ->with('success', $message);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = $this->repository->getById($id);
        return new JsonResponse([
            'data' => $data,
            'status' => 200,
        ], 200);
    }

    /**
     * @param EventTypeRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(EventTypeRequest $request, $id): JsonResponse
    {
        $this->repository->update($id, $request->validated());
        $message = successMessage('UPDATED', 'Event Type');
        $request->session()->flash('success', $message);
        return new JsonResponse([
            'data' => [],
            'status' => 200,
        ], 200);
    }

}
