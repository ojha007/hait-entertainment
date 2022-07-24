<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{

    protected $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function listAll(array $attributes = [])
    {
        return $this->getModel()
            ->with('role')
            ->when(isset($attributes['role_id']), function ($query) use ($attributes) {
                $query->where('role_id', '=', $attributes['role_id']);
            })
            ->get();
    }

    public function selectRoles(): Collection
    {
        return DB::table('roles')
            ->select('id', 'name')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function ($role) {
                return [
                    $role->id => ucfirst($role->name)
                ];
            });
    }

}
