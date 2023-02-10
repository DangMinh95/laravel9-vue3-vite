<?php

namespace App\Repositories\Order;


use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderRepository implements OrderRepositoryInterface
{

    public function createOrder($data)
    {
        $order = Order::create([
            'user_id' => Auth::id()
        ]);
        foreach ($data as $key => $value){
            $order->products()->attach($key, ['quantity' => $value ?? 1]);
        }
    }

    public function getOrderOfUser()
    {
        return Auth::user()->orders()->get();
    }
}
