<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function createOrder(Request $request)
    {
        $data = $request->only(['productOrder']);

        try {
            DB::beginTransaction();
            $this->orderRepositoryInterface->createOrder($data['productOrder']);
            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
//            dd($e->getMessage());
            return response()->json([
                'status' => 'Error',
                'code' => '500',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'Success',
            'code' => '200',
            'data' => []
        ]);
    }

    public function getOrderOfUser()
    {
        try {
            $order = $this->orderRepositoryInterface->getOrderOfUser();
        } catch (Exception $e) {
//            dd($e->getMessage());
            return response()->json([
                'Message' => 'Error',
                'Status' => 500,
                'Data' => []
            ]);
        }

        return response()->json([
            'Message' => 'Success',
            'Status' => 200,
            'Data' => $order
        ]);
    }
}
