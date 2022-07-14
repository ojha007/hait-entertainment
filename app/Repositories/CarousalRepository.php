<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\Carousal;

class CarousalRepository extends Repository
{

    protected $model;

    /**
     * @param Carousal $model
     */
    public function __construct(Carousal $model)
    {
        $this->model = $model;
    }

    public function getAllImages()
    {
        return $this->getModel()
            ->orderByDesc('order')
            ->get();
    }

    public function getImages($size)
    {
        return $this->getModel()
            ->orderByDesc('order')
            ->take($size)
            ->get();
    }
}
