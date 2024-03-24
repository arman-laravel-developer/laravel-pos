@extends('admin.master')

@section('title')
    Order Detail | Laravel pos
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Order Code: {{$order->order_code}}</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Product Name</th>
                            <th>QTY</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Tax Amount</th>
                            <th>Discount Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $orderDetail->product->name }}</td>
                                <td>{{ $orderDetail->quantity }}</td>
                                <td>{{ number_format($orderDetail->unit_price) }}</td>
                                <td>${{ number_format($orderDetail->total_price) }}</td>
                                <td>{{ $orderDetail->tax_amount }}</td>
                                <td>{{ $orderDetail->discount }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection
