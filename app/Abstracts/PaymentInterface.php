<?php

namespace App\Abstracts;

interface PaymentInterface
{

    public function pay(array $attributes);

}
