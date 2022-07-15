<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarousalRequest;
use App\Repositories\CarousalRepository;
use App\Traits\FileUploader;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CarousalController extends Controller
{


    use FileUploader;


    protected $modelName = 'Slider Image';
    /**
     * @var string
     */
    protected $viewPath = 'backend.carousal.';

    /**
     * @var string
     */
    protected $routePath = 'internal.carousals';
    /**
     * @var CarousalRepository
     */
    protected $repository;


    /**
     * @param CarousalRepository $repository
     */
    public function __construct(CarousalRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index()
    {

        $images = $this->repository->getAllImages();
        return view($this->viewPath . 'index', compact('images'));
    }

    public function store(CarousalRequest $request): RedirectResponse
    {
        try {
            $attributes = $request->validated();
            $attributes['order'] = 1;
            $attributes['url'] = $this->uploadFile($request->file('image'), 'slider');
            $this->repository->create($attributes);
            $message = successMessage('CREATED', $this->modelName);
            return redirect()
                ->back()
                ->with('success', $message);
        } catch (Throwable $exception) {
            $message = errorMessage('CREATE', $this->modelName);
            return redirect()
                ->back()
                ->withInput()
                ->with('failed', $message);
        }
    }

    public function destroy($id): RedirectResponse
    {
        $this->repository->delete($id);
        $message = successMessage('DELETED', $this->modelName);
        return redirect()
            ->back()
            ->with('success', $message);
    }
}
