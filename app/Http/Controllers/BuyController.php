<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\CartOrders;
use App\Models\ProductsModel;


class BuyController extends Controller
{
    public function list()
{
    // Fetch orders for today and mark them as read
    $orders = Orders::whereDate('created_at', now()->toDateString())->get();

    // Mark orders as 'read' after fetching them
    Orders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)  // Ensure we only mark unread orders as read
        ->update(['is_read' => true]);

    // Get the count of unread orders for today
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Get the count of unread cart orders for today
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();
    // Return the view with the orders and unread order count
    return view('buy.orders', compact('orders', 'newOrderCount', 'newCartCount'));
}

 public function list_sub()
{
    // Fetch orders for today and mark them as read
    $orders = Orders::whereDate('created_at', now()->toDateString())->get();

    // Mark orders as 'read' after fetching them
    Orders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)  // Ensure we only mark unread orders as read
        ->update(['is_read' => true]);

    // Get the count of unread orders for today
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Get the count of unread cart orders for today
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();
    // Return the view with the orders and unread order count
    return view('buy.orders_sub', compact('orders', 'newOrderCount', 'newCartCount'));
}

public function cartorders()
{
    // ✅ Get the count of unread orders for today BEFORE marking them as read
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // ✅ Get unread Orders count (if needed elsewhere)
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Fetch orders for today
    $orders = CartOrders::whereDate('created_at', now()->toDateString())->get();

    // ✅ Now mark orders as 'read' AFTER counting
    CartOrders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)
        ->update(['is_read' => true]);

    // Return the view with the orders and unread order count
    return view('buy.cartorders', compact('orders', 'newCartCount', 'newOrderCount'));
}

public function sub_cartorders()
{
    // ✅ Get the count of unread orders for today BEFORE marking them as read
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // ✅ Get unread Orders count (if needed elsewhere)
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Fetch orders for today
    $orders = CartOrders::whereDate('created_at', now()->toDateString())->get();

    // ✅ Now mark orders as 'read' AFTER counting
    CartOrders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)
        ->update(['is_read' => true]);

    // Return the view with the orders and unread order count
    return view('buy.sub_cartorders', compact('orders', 'newCartCount', 'newOrderCount'));
}


    
public function customerindex()
{
    if (Auth::check()) {
        $data['getRecord'] = DB::table('orders')
            ->join('produk', 'orders.product_id', '=', 'produk.id_produk')
            ->join('users', 'orders.user_id', '=', 'users.id') // ✅ Join users table
            ->where('orders.user_id', Auth::id()) // ✅ Filter for logged-in user
            ->select('orders.*', 'produk.nama_produk', 'users.name', 'users.email')
            ->get();

        return view('buy.customerlist', $data);
    } else {
        return redirect()->route('login')->with('error', 'Please log in to view your orders.');
    }
}


    

    public function neworders()
    {// Fetch products from the 'produk' table
    $products = DB::table('produk')->get();

    // Pass products to the view
    return view('buy.order', compact('products'));
    }

    public function customer()
    {
        return view('buy.return');
    }

    public function customerz()
    {
        return view('buy.home');
    }

    public function StoreBuy(Request $request)
{
    // Create a new instance of the Orders model
    $save = new Orders;

    // Capture form data from the request
    $save->contact = $request->contact;
    $save->quantity = $request->quantity;
    $save->location = $request->location;

    // Capture the name and email from the request
    // These fields should be included in the form
    $save->name = $request->name; // Get the name from the form input
    $save->email = $request->email; // Get the email from the form input
    $save->created_at = now()->setTimezone('Africa/Kampala');


    // Capture the user ID if the user is logged in
    if (Auth::check()) {
        $save->user_id = Auth::user()->id; 
    } else {
        $save->user_id = 0; // Set to null if not logged in
    }

    // Save the order to the database
    $save->save();

    // Redirect back to the orders list with a success message
    return redirect('/combhoneyz')->with('success', 'We have received your order and we are soon going to work on you. Thank you!');
}



public function StoreBuys(Request $request)
{
    // Validate form inputs (excluding name, contact, and email)
    $request->validate([
        'location' => 'required|string|max:255',
        'product' => 'required|array',
        'product.*' => 'required|integer|exists:produk,id_produk',
        'quantity' => 'required|array',
        'quantity.*' => 'required',
    ]);

    // Get logged-in user
    $user = Auth::user();

    // Loop through selected products and save each order
    foreach ($request->product as $index => $productId) {
        $order = new Orders;

        // Use user data instead of form inputs
        $order->name = $user->name;
        $order->contact = $user->contact;
        $order->email = $user->email;
        $order->location = $request->location;

        // Product details
        $order->product_id = $productId;
        $order->quantity = $request->quantity[$index];
        $order->created_at = now()->setTimezone('Africa/Kampala');

        // Link order to user
        $order->user_id = $user->id;

        // Save order
        $order->save();
    }

      // Redirect with success message
    return redirect('/myorders/customer')->with('success', 'We have received your order and will process it shortly. Thank you!');
}




    public function index(){
        $data['getRecord'] = Orders::get();
        return view('buy.list', $data);
    }

    public function daily()
    {
        // Fetch orders for today and mark them as read
    $orders = Orders::whereDate('created_at', now()->toDateString())->get();

    // Mark orders as 'read' after fetching them
    Orders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)  // Ensure we only mark unread orders as read
        ->update(['is_read' => true]);

    // Get the count of unread orders for today
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Get the count of unread cart orders for today
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Return the view with the orders and unread order count
    return view('buy.daily', compact('orders', 'newOrderCount', 'newCartCount'));
    }

    public function userdaily()
    {
       // Fetch orders for today and mark them as read
    $orders = Orders::whereDate('created_at', now()->toDateString())->get();

    // Mark orders as 'read' after fetching them
    Orders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)  // Ensure we only mark unread orders as read
        ->update(['is_read' => true]);

    // Get the count of unread orders for today
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Return the view with the orders and unread order count
    return view('buy.userdaily', compact('orders', 'newOrderCount', 'newCartCount'));
        
       
    }
    
    

    public function add_orders()
    {
        return view('buy.add');
    }

    public function insert_add_orders(Request $request)
{
    $productIds = $request->product_id;
    $quantities = $request->quantity;

    // Validate input
    $request->validate([
        'product_id.*' => 'required|exists:produk,id_produk',
        'quantity.*' => 'required',
        'contact' => 'required',
        'name' => 'required',
        'location' => 'required',
    ]);

    // Loop through the selected products
    foreach ($productIds as $index => $productId) {
        $order = new Orders();
        $order->product_id = $productId;
        $order->quantity = $quantities[$index];
        $order->contact = $request->contact;
        $order->location = $request->location;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->created_at = now()->setTimezone('Africa/Kampala');
        $order->user_id = Auth::check() ? Auth::id() : 0;
        $order->save();
    }

    return redirect()->route('orders')->with('success', 'Order created successfully.');
}




    public function getData()
    {
        $orders = Orders::leftJoin('produk', 'orders.product_id', '=', 'produk.id_produk')
            ->select([
                'orders.id',
                'orders.name',
                'orders.contact',
                'orders.email',
                'orders.quantity',
                'orders.location',
                'orders.created_at',
                'produk.nama_produk as product'
            ]);

        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)
                    ->timezone('Africa/Kampala')
                    ->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($order) {
                $deleteUrl = route('orders.destroy', $order->id);
                return '<button class="btn btn-sm btn-danger" onclick="deleteOrder(\''.$deleteUrl.'\')">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        Orders::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }


public function getDataCart()
{
    $orders = CartOrders::select([
            'cartorders.id',             
            'cartorders.name',
            'cartorders.contact',
            'cartorders.email',
            'cartorders.quantity',
            'cartorders.location',
            'cartorders.created_at',
            'products.type as product_name'
        ])
        ->leftJoin('products', 'cartorders.product_id', '=', 'products.id');

    return DataTables::of($orders)
        ->editColumn('created_at', function ($order) {
            return Carbon::parse($order->created_at)
                ->setTimezone('Africa/Kampala')
                ->format('d-m-Y H:i:s');
        })
        ->addColumn('action', function ($order) {
            $deleteUrl = route('cartorders.delete', $order->id);
            return '<button class="btn btn-danger btn-sm delete-order" data-url="'.$deleteUrl.'" data-id="'.$order->id.'">
                        <i class="fa fa-trash"></i> Delete
                    </button>';
        })
        ->rawColumns(['action']) // allow HTML
        ->make(true);
}

public function sub_getDataCart()
{
    $orders = CartOrders::select([
            'cartorders.id',             
            'cartorders.name',
            'cartorders.contact',
            'cartorders.email',
            'cartorders.quantity',
            'cartorders.location',
            'cartorders.created_at',
            'products.type as product_name'
        ])
        ->leftJoin('products', 'cartorders.product_id', '=', 'products.id');

    return DataTables::of($orders)
        ->editColumn('created_at', function ($order) {
            return Carbon::parse($order->created_at)
                ->setTimezone('Africa/Kampala')
                ->format('d-m-Y H:i:s');
        })
        
        ->rawColumns(['action']) // allow HTML
        ->make(true);
}

public function deleteCartOrder($id)
{
    $order = CartOrders::findOrFail($id);
    $order->delete();

    return response()->json(['success' => true]);
}

public function customerindex_online()
{
    if (Auth::check()) {
        $userId = Auth::id();

        // Fetch cart orders for the logged-in user
        $data['getRecord'] = CartOrders::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('buy.customerlist_online', $data);
    } else {
        return redirect()->route('login')->with('error', 'Please log in to view your orders.');
    }
}


public function neworders_online()
    {// Fetch products from the 'produk' table
    $products = DB::table('products')->get();

    // Pass products to the view
    return view('buy.order_online', compact('products'));
    }

  public function StoreBuys_online(Request $request)
{
   

    // Get logged-in user
    $user = Auth::user();

    // Loop through selected products and save each order
    foreach ($request->product as $index => $productId) {
        $product = ProductsModel::findOrFail($productId);

        $order = new Orders;

        // User details
        $order->name = $user->name;
        $order->contact = $user->contact;
        $order->email = $user->email;
        $order->location = $request->location;

        // Product details
        $order->product_id = $productId;
        $order->quantity = $request->quantity[$index];

        // ✅ Calculate total_price using price column
        $order->total_price = $product->price * $order->quantity;

        $order->created_at = now()->setTimezone('Africa/Kampala');
        $order->user_id = $user->id;

        $order->save();
    }

    // Redirect to correct route
    return redirect('/myorders/customer')->with('success', 'We have received your order and will process it shortly. Thank you!');
}


//get data for sub admin

 public function getData_sub()
    {
        $orders = Orders::leftJoin('produk', 'orders.product_id', '=', 'produk.id_produk')
            ->select([
                'orders.id',
                'orders.name',
                'orders.contact',
                'orders.email',
                'orders.quantity',
                'orders.location',
                'orders.created_at',
                'produk.nama_produk as product'
            ]);

        return DataTables::of($orders)
            ->addIndexColumn()
            ->editColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)
                    ->timezone('Africa/Kampala')
                    ->format('d-m-Y H:i:s');
            })
           
            ->rawColumns(['action'])
            ->make(true);
    }

     public function daily_sub()
    {
        // Fetch orders for today and mark them as read
    $orders = Orders::whereDate('created_at', now()->toDateString())->get();

    // Mark orders as 'read' after fetching them
    Orders::whereDate('created_at', now()->toDateString())
        ->where('is_read', false)  // Ensure we only mark unread orders as read
        ->update(['is_read' => true]);

    // Get the count of unread orders for today
    $newOrderCount = Orders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Get the count of unread cart orders for today
    $newCartCount = CartOrders::whereDate('created_at', now()->toDateString())
                            ->where('is_read', false)
                            ->count();

    // Return the view with the orders and unread order count
    return view('buy.daily_sub', compact('orders', 'newOrderCount', 'newCartCount'));
    }

}
