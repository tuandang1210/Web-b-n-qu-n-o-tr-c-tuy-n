<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CustomerController 
{

    public function homepage()
    {
        $products = Product::inRandomOrder()->limit(8)->get();

        return view('customer.homepage', compact('products'));
    }

    // Trang liên hệ
    public function contact()
    {
        return view('customer.contact');
    }

    // Trang thanh toán
    public function checkout()
    {
        $user = Session::get('user');
     
        $cart = Cart::with('items.product')
            ->where('user_id', $user->user_id)
            ->first();

        $cartItems = $cart ? $cart->items : collect([]);
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        return view('customer.checkout', compact('cartItems', 'total'));
    }

        // Trang giỏ hàng
    public function cart()
    {
        $user = Session::get('user'); 

        $cartItems = CartItem::with('product')
            ->whereHas('cart', function($q) use ($user) {
                $q->where('user_id', $user->user_id);
            })
            ->get();

        return view('customer.cart', compact('cartItems'));
    }
    
    // Trang cửa hàng (danh sách sản phẩm)
    public function shop(Request $request)
    {
        $search = $request->input('search_product');

        $products = Product::query()
            ->when($search, function($query) use ($search) {
                $search = strtolower($search);
                $query->whereRaw('LOWER(name) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(brand) LIKE ?', ["%$search%"]);
            })
            ->paginate(8);

        return view('customer.shop', compact('products', 'search'));
    }


    // Trang chi tiết sản phẩm
    public function sproduct($id)
    {
        $product = Product::findOrFail($id); 
        $relatedProducts = Product::inRandomOrder()->limit(4)->get();


        return view('customer.sproduct', compact('product', 'relatedProducts'));
    }

    public function remove($product_id, $size)
    {
        $user = Session::get('user');

        $cart = Cart::where('user_id', $user->user_id)->first();

        $deleted = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product_id)
            ->where('size', $size)
            ->delete();

        if ($deleted == 0) {
            return back()->with('error', 'Không tìm thấy sản phẩm để xóa!');
        }

        return redirect()->route('customer.cart')
            ->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function placeOrder(Request $request)
    {
        $user = Session::get('user');

        $cart = Cart::where('user_id', $user->user_id)->first();

        if (!$cart) {
            return back()->with('error', 'Your cart is empty.');
        }

        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->cart_id)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->quantity * $item->product->price;
        }

        $order = Order::create([
            'user_id'       => $user->user_id,
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'address'       => $request->address,
            'payment_method'=> $request->payment,
            'total_amount'  => $total,
            'username'      => $user->username,
            'created_at'    => now(),
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->order_id,
                'product_id' => $item->product_id,
                'size'       => $item->size,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        CartItem::where('cart_id', $cart->cart_id)->delete();

        return redirect()->route('customer.cart')
            ->with('success', 'Order placed successfully!');
    }

//          phần order
    public function myOrders()
    {
        $user = Session::get('user'); 

        $orders = Order::where('user_id', $user->user_id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $orderItems = [];
        foreach ($orders as $order) {
            $orderItems[$order->order_id] = OrderItem::select(
                'order_items.*',
                'products.name',
                'products.image',
                'products.price'
            )
            ->leftJoin('products', 'products.product_id', '=', 'order_items.product_id')
            ->where('order_items.order_id', $order->order_id)
            ->get();
        }

        return view('customer.orders', compact('orders', 'orderItems'));
    }
 
}
