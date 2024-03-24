<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);
        $cartItems = CartItem::with('product')->get();
        return view('pos::index', compact('products', 'cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1);
        $cartItem = CartItem::where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
        $cartItems = CartItem::with('product')->get();
        $cartContent = view('pos::shopping_cart', compact('cartItems'))->render();
        return response()->json($cartContent);
    }

    public function updateCartQuantity(Request $request)
    {
        try {
            $itemId = $request->input('itemId');
            $newQuantity = $request->input('newQuantity');

            $cartItem = CartItem::findOrFail($itemId);

            if ($newQuantity === 0) {
                return $this->deleteFromCart($request);
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            $cartItems = CartItem::with('product')->get();
            $cartContent = view('pos::shopping_cart', compact('cartItems'))->render();

            return response()->json($cartContent);
        } catch (\Exception $e) {
            \Log::error('Error in updateCartQuantity function: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred. Please try again later.'], 500);
        }
    }

    public function placeOrder()
    {
        $cartItems = CartItem::all();
        $order = new Order();
        $order->customer_name = 'Walk-in Customer';
        $order->payment_type = 'Cash';

        $totalOrderAmount = 0;
        $totalOrderedQty = 0;

        $order->order_code = 'ORD' . date('Ymd') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);
        $order->save();

        foreach ($cartItems as $item) {
            $basePrice = $item->product->selling_price;
            $discountPercentage = $item->product->discount ?? 0;
            $discountedPrice = $basePrice - ($basePrice * $discountPercentage / 100);

            $totalOrderedQty += $item->quantity;

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->product_id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->unit_price = $discountedPrice;

            $discountAmount = $basePrice * $item->quantity * $discountPercentage / 100;
            $orderDetail->discount = $discountAmount;

            $subtotal = ($basePrice - $discountAmount) * $item->quantity;
            $tax = $item->product->tax ?? 0;
            $taxAmount = $subtotal * $tax / 100;

            $orderDetail->total_price = $subtotal + $taxAmount;
            $orderDetail->tax_amount = $taxAmount;

            $totalOrderAmount += $orderDetail->total_price;

            $orderDetail->save();
            $item->delete();
        }

        $order->order_total = $totalOrderAmount;
        $order->payable_amount = $totalOrderAmount;
        $order->qty = $totalOrderedQty;
        $order->save();

        $cartItems = CartItem::with('product')->get();
        $cartContent = view('pos::shopping_cart', compact('cartItems'))->render();

        session()->flash('success', 'Your order has been placed successfully.');
        return response()->json($cartContent);
    }

    public function deleteFromCart(Request $request)
    {
        $itemId = $request->input('itemId');
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();
        $cartItems = CartItem::with('product')->get();
        $cartContent = view('pos::shopping_cart', compact('cartItems'))->render();
        return response()->json($cartContent);
    }
}
