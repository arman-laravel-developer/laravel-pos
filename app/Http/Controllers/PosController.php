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
        return view('admin.pos.index', compact('products', 'cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1); // Default quantity is 1 if not provided

        // Check if the product is already in the cart
        $cartItem = CartItem::where('product_id', $productId)->first();

        if ($cartItem) {
            // If the product is already in the cart, update its quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            CartItem::create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        // Fetch updated cart items
        $cartItems = CartItem::with('product')->get();
        // You can return the updated cart items to update the UI if needed
        $cartContent = view('partials.shopping_cart', compact('cartItems'))->render(); // Assuming you have a partial view for shopping cart items
        return response()->json($cartContent);
    }

    public function updateCartQuantity(Request $request)
    {
        try {
            $itemId = $request->input('itemId');
            $newQuantity = $request->input('newQuantity');

            $cartItem = CartItem::findOrFail($itemId);

            if ($newQuantity === 0) {
                // If new quantity is 0, trigger delete function
                return $this->deleteFromCart($request);
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            $cartItems = CartItem::with('product')->get(); // Get updated cart items
            $cartContent = view('partials.shopping_cart', compact('cartItems'))->render(); // Assuming you have a partial view for shopping cart items

            return response()->json($cartContent);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in updateCartQuantity function: ' . $e->getMessage());
            // Return a JSON response with error message
            return response()->json(['error' => 'An error occurred. Please try again later.'], 500);
        }
    }


    public function placeOrder(Request $request)
    {
        // Retrieve cart items from the cart_items table
        $cartItems = CartItem::all(); // Or you can adjust this to fetch only relevant cart items based on your logic

        foreach ($cartItems as $item) {
            $order = new Order();
            $order->product_id = $item->product_id; // Assuming you have a product_id field in your cart_items table
            $order->customer_name = 'Walk-in Customer'; // Always set as Walk-in Customer
            $order->qty = $item->quantity;
            $order->order_total = $item->quantity * $item->product->selling_price;
            $order->payable_amount = $order->order_total; // Assuming no discount applied at order level
            $order->payment_type = 'Cash'; // Assuming payment type is Cash, you can adjust this
            $order->save();
        }

        foreach ($cartItems as $cartItem)
        {
            $cartItem->delete();
        }

        $cartItems = CartItem::with('product')->get(); // Get updated cart items
        $cartContent = view('partials.shopping_cart', compact('cartItems'))->render(); // Assuming you have a partial view for shopping cart items

        return response()->json($cartContent);
    }

    public function deleteFromCart(Request $request)
    {
        $itemId = $request->input('itemId');
        // Find the cart item by ID
        $cartItem = CartItem::findOrFail($itemId);
        // Delete the cart item
        $cartItem->delete();
        // Fetch updated cart items after deletion
        $cartItems = CartItem::with('product')->get();
        // Render the updated cart content
        $cartContent = view('partials.shopping_cart', compact('cartItems'))->render(); // Assuming you have a partial view for shopping cart items
        return response()->json($cartContent);
    }
}
