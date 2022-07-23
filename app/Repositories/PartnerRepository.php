<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\Partner;

class PartnerRepository extends Repository
{

    protected $model;

    /**
     * @param Partner $model
     */
    public function __construct(Partner $model)
    {
        $this->model = $model;
    }


}
