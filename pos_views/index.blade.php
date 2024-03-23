@extends('admin.master')

@section('title')
    Pos | Laravel pos
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Product list -->
                <div class="card">
                    <div class="card-header">
                        <input class="form-control" type="text" id="searchInput" placeholder="Search by Product Name">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6 product-item">
                                    <div class="card add-to-cart h-100" data-product-id="{{ $product->id }}" style="cursor: pointer;pointer-events: auto; margin-bottom: 0px!important;">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top" style="max-width: 100%; height: 100px; padding: 6%">
                                        <div class="card-body">
                                            <p class="product-name text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $product->name }}">{{ $product->name }}</p>
                                            <span class="product-price text-center">
                                                @php
                                                    $discountedPrice = $product->selling_price - ($product->selling_price * $product->discount / 100);
                                                @endphp
                                                @if($product->discount > 0)
                                                    <span style="font-size: 80%; margin-bottom: 0px!important;">${{ $discountedPrice }}</span> <del style="font-size: 70%;margin-bottom: 0px!important;">${{ $product->selling_price }}</del>
                                                @else
                                                    <span style="font-size: 80%; margin-bottom: 0px!important;">${{ $product->selling_price }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $products->links('pagination::bootstrap-4', ['prev_text' => 'Previous', 'next_text' => 'Next']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Shopping cart -->
                <div class="card">
                    <div class="card-header" style="margin-bottom: -10%">Shopping Cart</div>
                    <div class="card-body" id="shopping-cart">
                        @if (count($cartItems) > 0)
                            <table class="table w-100">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $subtotal = 0; ?>
                                @foreach ($cartItems as $item)
                                    <?php
                                    $productDiscount = $item->product->discount;
                                    $subtotal += $item->quantity * $item->product->selling_price;
                                    $discountAmount = ($productDiscount / 100) * $subtotal;
                                    ?>
                                    <tr>
                                        <td><img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="height: 30px; width: 30px;"><span>{{ \Illuminate\Support\Str::limit($item->product->name, 4) }}</span></td>
                                        <td>
                                            <input type="number" class="cart-quantity" style="width: 40px;" min="1" value="{{ $item->quantity }}" data-item-id="{{ $item->id }}">
                                        </td>
                                        <td>${{ $item->product->selling_price }}</td>
                                        <td>
                                            <button class="delete-from-cart" style="border: none; color: red" data-item-id="{{ $item->id }}"><i class="uil-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                <div>
                                    <p>Subtotal: <span style="float: right;">${{ $subtotal }}</span></p>
                                    <p>Product Discount: <span style="float: right;">${{ $discountAmount }}</span></p>
                                    <?php
                                    $totalTax = 0;
                                    foreach ($cartItems as $item) {
                                        $totalTax += ($item->quantity * $item->product->selling_price * $item->product->tax) / 100;
                                    }
                                    $total = $subtotal + $totalTax - $discountAmount;
                                    ?>
                                    <p>Total Tax: <span style="float: right;">${{ $totalTax }}</span></p>
                                    <p>Total: <span style="float: right;">${{ $total }}</span></p>
                                </div>
                            </div>
                        @else
                            <p>No items in the cart</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <button id="place-order" class="form-control btn btn-info">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add to cart button click handler
            $('.add-to-cart').click(function() {
                var productId = $(this).data('product-id');
                addToCart(productId);
            });

            // Delete from cart button click handler
            $(document).on('click', '.delete-from-cart', function() {
                var itemId = $(this).data('item-id');
                deleteFromCart(itemId);
            });

            // Place order button click handler
            $('#place-order').click(function() {
                placeOrder();
            });

            // Function to add product to cart
            function addToCart(productId) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('add-to-cart')}}',
                    data: {
                        productId: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#shopping-cart').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to delete item from cart
            function deleteFromCart(itemId) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('delete-form-cart')}}',
                    data: {
                        itemId: itemId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#shopping-cart').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to place order
            function placeOrder() {
                $.ajax({
                    type: 'POST',
                    url: '{{route('place-order')}}',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#shopping-cart').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Quantity input change event handler
            $(document).on('change', '.cart-quantity', function() {
                var itemId = $(this).data('item-id');
                var newQuantity = $(this).val();
                updateCartQuantity(itemId, newQuantity);
            });

            // Function to update cart quantity
            function updateCartQuantity(itemId, newQuantity) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('update-cart-quantity')}}',
                    data: {
                        itemId: itemId,
                        newQuantity: newQuantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#shopping-cart').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            // Search input keyup event handler
            $('#searchInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                $('.product-item').each(function() {
                    var productName = $(this).find('.product-name').text().toLowerCase();
                    if (productName.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endsection

