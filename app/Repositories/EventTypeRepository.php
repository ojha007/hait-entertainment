<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\EventType;

class EventTypeRepository extends Repository
{

    protected $model;

    /**
     * @param EventType $model
     */
    public function __construct(EventType $model)
    {
        $this->model = $model;
    }

    public function selectEventTypes()
    {
        return $this->getAll()
            ->mapWithKeys(function ($e) {
                return [$e->id => $e->name];
            });
    }

}
