<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
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

        foreach ($cartItems as $item) {
            $order = new Order();
            $order->product_id = $item->product_id;
            $order->customer_name = 'Walk-in Customer';
            $order->qty = $item->quantity;

            $basePrice = $item->product->selling_price;
            $discount = $item->product->discount ?? 0;
            $discountedPrice = $basePrice - ($basePrice * $discount / 100);

            $order->order_total = $discountedPrice * $item->quantity;

            $tax = $item->product->tax ?? 0;
            $taxAmount = $order->order_total * $tax / 100;

            $order->payable_amount = $order->order_total + $taxAmount;
            $order->payment_type = 'Cash';
            $order->save();
        }
        foreach ($cartItems as $cartItem)
        {
            $cartItem->delete();
        }

        $cartItems = CartItem::with('product')->get();
        $cartContent = view('pos::shopping_cart', compact('cartItems'))->render();

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
