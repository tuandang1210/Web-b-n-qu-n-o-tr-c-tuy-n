<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $cart = Cart::with('items.product')
            ->where('user_id', $user->user_id)
            ->first();

        $cartItems = $cart ? $cart->items : collect([]);

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

        $deleted = $cart->items()
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

        $cart = Cart::with('items.product')
            ->where('user_id', $user->user_id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
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

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id'   => $order->order_id,
                'product_id' => $item->product_id,
                'size'       => $item->size,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        $cart->items()->delete();

        return redirect()->route('customer.cart')
            ->with('success', 'Order placed successfully!');
    }

//          phần order
    public function myOrders()
    {
        $user = Session::get('user'); 

        $orders = Order::with('items.product')
        ->where('user_id', $user->user_id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('customer.orders', compact('orders'));
    }
 
    //trang contact
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::send('customer.email', [
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->message,
        ], function ($mail) use ($request) {
            $mail->to('dqt465@gmail.com')
                 ->subject($request->subject);
        });

        return back()->with('success', 'Gửi thành công!');
    }
}
