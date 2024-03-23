<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admin.orders.order', compact('orders'));
    }

    public function search(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Number of records per page
        $query = Order::query();

        // Date range filter
        $startDate = null;
        $endDate = null;
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Add one day to the end date
            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Paginate the results
        $orders = $query->paginate($perPage);

        // Pass start date and end date to the view
        return view('admin.orders.order', compact('orders', 'startDate', 'endDate'));
    }

}
