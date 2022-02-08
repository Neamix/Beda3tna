<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function upsert(OrderRequest $request) 
    {
        return Order::upsertInstance($request);
    }

    public function delete(Order $order)
    {
        return $order->deleteInstance();
    }
}
