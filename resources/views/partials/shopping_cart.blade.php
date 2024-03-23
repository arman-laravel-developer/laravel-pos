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
                <td><img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="height: 20px;"></td>
                <td>
                    <input type="number" class="cart-quantity" style="width: 50px;" min="1" value="{{ $item->quantity }}" data-item-id="{{ $item->id }}">
                </td>
                <td>${{ $item->product->selling_price }}</td>
                <td>
                    <button class="delete-from-cart" data-item-id="{{ $item->id }}"><i class="uil-trash"></i></button>
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
            <button id="place-order" class="form-control btn btn-info">Place Order</button>
        </div>
    </div>
@else
    <p>No items in the cart</p>
    <button id="place-order" class="form-control btn btn-info">Place Order</button>
@endif
