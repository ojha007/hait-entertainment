<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\TicketType;

class TicketTypeRepository extends Repository
{
    protected $model;

    /**
     * @param TicketType $model
     */
    public function __construct(TicketType $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function selectTicketTypes()
    {
        return $this
            ->getAll()
            ->mapWithKeys(function ($t) {
                return [$t->id => $t->name];
            });
    }
}
