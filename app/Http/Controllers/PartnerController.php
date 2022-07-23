<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnerRequest;
use App\Repositories\PartnerRepository;
use App\Traits\FileUploader;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class PartnerController extends Controller
{

    use FileUploader;

    /**
     * @var string
     */
    protected $viewPath = 'backend.partners.';

    /**
     * @var string
     */
    protected $message = 'Partner';

    /**
     * @var string
     */
    protected $routePrefix = 'internal.master.partners.';

    protected $repository;

    /**
     * @param PartnerRepository $repository
     */
    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $partners = $this->repository->getAll();
        return view($this->viewPath . 'index', compact('partners'));

    }

    /**
     * @param PartnerRequest $request
     * @return RedirectResponse
     */
    public function store(PartnerRequest $request): RedirectResponse
    {
        try {
            $attributes = $request->validated();
            $attributes['image'] = $this->uploadFile($request->file('image'), 'partners');
            $this->repository->create($attributes);
            $message = successMessage('CREATED', $this->message);
            return redirect()
                ->route($this->routePrefix . 'index')
                ->with('success', $message);
        } catch (Throwable $exception) {
            $message = errorMessage('CREATE', $this->message);
            return redirect()
                ->back()
                ->withInput()
                ->with('failed', $message);
        }
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->repository->delete($id);
        $message = successMessage('DELETED', $this->message);
        return redirect()
            ->back()
            ->with('success', $message);
    }

}
