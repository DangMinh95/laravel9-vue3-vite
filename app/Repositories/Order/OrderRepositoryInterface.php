<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    public function createOrder($data);

    public function getOrderOfUser();
}
