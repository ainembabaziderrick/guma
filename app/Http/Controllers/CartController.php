<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartOrders;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use App\Models\Orders;


class CartController extends Controller
{
  public function addToCart(Request $request)
{
    $productId = $request->query('product_id');
    if(!$productId) {
        return redirect()->back()->with('error', 'No product ID provided');
    }

    $product = DB::table('products')->where('id', $productId)->first();

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }

    $cart = session()->get('cart', []);

    if(isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "name" => $product->type,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('view.cart')->with('success', 'Product added to cart!');
}



    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }


    public function checkout()
{
    $cart = session()->get('cart', []);
    $cart_count = array_sum(array_column($cart, 'quantity'));
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return view('checkout', compact('cart', 'total', 'cart_count'));
}

public function processCheckout(Request $request)
{
    // Validate form inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'total' => 'required|numeric',
    ]);

    // Get logged-in user
    $user = Auth::user();

    // Get cart from session
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Loop through cart items and save each as an order
   foreach ($cart as $productId => $item) {
    $order = new CartOrders();

    $order->name = $request->name;
    $order->contact = $request->phone;
    $order->email = $request->email;
    $order->location = $request->address;

    $order->product_id = $productId;
    $order->product = $item['name'];
    $order->quantity = $item['quantity'];
    $order->total_price = $item['price'] * $item['quantity'];
    $order->created_at = now()->setTimezone('Africa/Kampala');

    $order->user_id = $user ? $user->id : 0;

    $order->save();
}

    // Clear cart
    session()->forget('cart');

    // Redirect with success message
    return redirect('/')->with('success', 'We have received your order and will process it shortly. Thank you!');
}



    
    // online account users
     public function addToCart_online(Request $request)
{
    $productId = $request->query('product_id');

    if(!$productId) {
        return redirect()->back()->with('error', 'No product ID provided');
    }

    $product = DB::table('products')->where('id', $productId)->first();

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found');
    }

    $cart = session()->get('cart', []);

    if(isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "name" => $product->type,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);

    // ✅ Route name must match viewCart_online()
    return redirect()->route('view.cart.online')->with('success', 'Product added to cart!');
}

public function viewCart_online()
{
    $cart = session()->get('cart', []);
    return view('buy.cart_online', compact('cart')); // make sure this view exists
}

public function updateCart_online(Request $request)
{
    if($request->id && $request->quantity){
        $cart = session()->get('cart');
        $cart[$request->id]["quantity"] = $request->quantity;
        session()->put('cart', $cart);
        session()->flash('success', 'Cart updated successfully');
    }
}

public function removeFromCart_online(Request $request)
{
    if($request->id) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Product removed successfully');
    }
}

 public function checkout_online()
{
    $cart = session()->get('cart', []);
    $cart_count = array_sum(array_column($cart, 'quantity'));
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return view('buy.checkout', compact('cart', 'total', 'cart_count'));
}

public function processCheckout_online(Request $request)
{
    $user = Auth::user();

    // Get cart from session
    $cart = session()->get('cart', []);

    if(empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Save each cart item as a separate order
    foreach($cart as $productId => $item) {
        $order = new CartOrders();

        $order->name = $user->name;
        $order->contact = $user->contact;
        $order->email = $user->email;
        $order->location = $user->address ?? '';

        $order->product_id = $productId;
        $order->product = $item['name'];
        $order->quantity = $item['quantity'];
        $order->total_price = $item['price'] * $item['quantity'];
        $order->user_id = $user->id;
        $order->created_at = now()->setTimezone('Africa/Kampala');

        $order->save();
    }

    // Clear cart session
session()->forget('cart');

// Redirect back with success message
return redirect()->back()->with('success', 'Your order has been placed successfully!');

}



    
}
