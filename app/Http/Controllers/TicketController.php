<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Repositories\TicketTypeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Throwable;

class TicketController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'backend.tickets.';


    protected $repository;

    /**
     * @param TicketTypeRepository $repository
     */
    public function __construct(TicketTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $tickets = $this->repository->getAll();
        return view($this->viewPath . 'index', compact('tickets'));
    }

    /**
     * @param TicketRequest $request
     * @return JsonResponse
     */
    public function store(TicketRequest $request): JsonResponse
    {
        try {
            $attributes = $request->validated();
            $this->repository->create($attributes);
            $message = successMessage('CREATED', 'Ticket');
            $request->session()->flash('success', $message);
            return new JsonResponse(['status' => 200, 'data' => []], 201);
        } catch (Throwable $exception) {
            $message = errorMessage('CREATE', 'Ticket');
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
        $message = successMessage('DELETED', 'Ticket');
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
            'message' => 'success',
            'status' => 200
        ], 200);
    }

    /**
     * @param TicketRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(TicketRequest $request, $id): JsonResponse
    {
        $this->repository->update($id,$request->validated());
        $message = successMessage('UPDATED', 'Ticket');
        $request->session()->flash('success', $message);
        return new JsonResponse([
            'data' => [],
            'message' => 'success',
            'status' => 200
        ], 200);
    }
}
