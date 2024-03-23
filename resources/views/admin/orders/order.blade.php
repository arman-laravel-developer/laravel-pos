@extends('admin.master')

@section('title')
    Orders | Laravel pos
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Orders Manage</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('orders.index') }}">
                        <input type="date" class="w-25" name="start_date" value="{{ request('start_date') }}" required>
                        <input type="date" class="w-25" name="end_date" value="{{ request('end_date') }}" required>
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-success">Reset</a>
                    </form>
                    @if($orders->isNotEmpty())
                        <table class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Customer Name</th>
                                <th>QTY</th>
                                <th>Order Total</th>
                                <th>Payment type</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($order->product->name, 15) }}</td>
                                    <td><img src="{{ asset($order->product->image) }}" alt="" style="height: 50px;"></td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>${{ number_format($order->order_total) }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td><a href="" class="btn btn-sm btn-danger"><i class="uil-trash"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links('pagination::bootstrap-4', ['prev_text' => 'Previous', 'next_text' => 'Next']) }}
                    @else
                        <div class="card card-body">
                            <p>No data found.</p>
                        </div>
                    @endif
                </div><!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection
