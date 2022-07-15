<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Repositories\BookingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
    public function index()
    {

        return view($this->viewPath . 'index');
    }

    public function store(BookingRequest $request)
    {
        try {
            $attributes = $request->validated();
        } catch (Throwable $exception) {

        }
    }
}

