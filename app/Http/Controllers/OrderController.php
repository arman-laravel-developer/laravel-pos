<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.orders.order', compact('orders'));
    }

    public function search(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $query = Order::query();

        $startDate = null;
        $endDate = null;
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $orders = $query->paginate($perPage);

        return view('admin.orders.order', compact('orders', 'startDate', 'endDate'));
    }

    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();
        Alert::success('Order Delete Successfull');
        return redirect()->back();
    }

    public function orderDetail($id)
    {
        $order = Order::find($id);
        return view('admin.orders.order-details', compact('order'));
    }

}
