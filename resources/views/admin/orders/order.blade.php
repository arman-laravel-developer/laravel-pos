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
                                <th>Order Code</th>
                                <th>Customer Name</th>
                                <th>QTY</th>
                                <th>Payable Amount</th>
                                <th>Payment type</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>${{ number_format($order->payable_amount) }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{route('order.detail', ['id' => $order->id])}}" class="btn btn-sm btn-success" title="show"><i class="uil-eye-slash"></i></a>
                                        <button type="button" onclick="confirmDelete({{$order->id}});" class="btn btn-sm btn-danger" title="delete"><i class="uil-trash"></i></button>
                                    </td>
                                    <form action="{{route('orders.delete', ['id' => $order->id])}}" method="POST" id="orderDeleteForm{{$order->id}}">
                                        @csrf
                                    </form>
                                    <script>
                                        function confirmDelete(orderId) {
                                            var confirmDelete = confirm('Are you sure you want to delete this?');
                                            if (confirmDelete) {
                                                document.getElementById('orderDeleteForm' + orderId).submit();
                                            } else {
                                                return false;
                                            }
                                        }
                                    </script>
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
