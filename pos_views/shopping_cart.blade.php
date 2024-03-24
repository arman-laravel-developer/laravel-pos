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
        <?php
        $subtotal = 0;
        $discountAmount = 0;
        $hasDiscount = false;
        ?>
        @foreach ($cartItems as $item)
            <?php
            $productDiscount = $item->product->discount;
            $itemSubtotal = $item->quantity * $item->product->selling_price;
            $subtotal += $itemSubtotal;
            if ($productDiscount > 0) {
                $hasDiscount = true;
                $discountAmount += ($productDiscount / 100) * $itemSubtotal;
            }
            ?>
            <tr>
                <td>
                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" style="height: 30px; width: 30px;">
                    <span>{{ \Illuminate\Support\Str::limit($item->product->name, 4) }}</span>
                </td>
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
            @if($hasDiscount)
                <p>Product Discount: <span style="float: right;">${{ $discountAmount }}</span></p>
            @endif
            <?php
            $totalTax = 0;
            foreach ($cartItems as $item) {
                $totalTax += ($item->quantity * $item->product->selling_price * $item->product->tax) / 100;
            }
            $total = $subtotal + $totalTax - ($hasDiscount ? $discountAmount : 0);
            ?>
            <p>Total Tax: <span style="float: right;">${{ $totalTax }}</span></p>
            <p>Total: <span style="float: right;">${{ $total }}</span></p>
        </div>
    </div>
@else
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
        <tr>
            <td colspan="4" class="text-center"><p>No items in the cart</p></td>
        </tr>
        </tbody>
    </table>
    <div>
        <div>
            <p>Subtotal: <span style="float: right;">$0</span></p>
            <p>Product Discount: <span style="float: right;">$0</span></p>
            <p>Total Tax: <span style="float: right;">$0</span></p>
            <p>Total: <span style="float: right;">$0</span></p>
        </div>
    </div>
@endif
