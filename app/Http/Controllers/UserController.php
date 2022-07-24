<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{


    /**
     * @var string
     */
    protected $viewPath = 'backend.users.';

    protected $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $attributes = $request->all();
        $users = $this->repository->listAll($attributes);
        $roles = $this->repository->selectRoles();
        return view($this->viewPath . 'index', compact('users', 'roles'));
    }

    public function show($id): JsonResponse
    {
        $user = $this->repository->getWith($id, 'role');
        return new JsonResponse([
            'data' => $user,
            'message' => 'SUCCESS',
        ], 200);
    }
}
