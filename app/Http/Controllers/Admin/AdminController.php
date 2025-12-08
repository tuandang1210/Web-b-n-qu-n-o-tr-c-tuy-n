<?php

namespace App\Http\Controllers\Admin;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController
{
    public function dashboard()
    {
        $orders = Order::select(
            DB::raw('DAYOFWEEK(created_at) as day'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', now()->subDays(6))
        ->groupBy('day')
        ->pluck('total', 'day')
        ->toArray();

        $ordersPerDay = array_fill(0, 7, 0);
        foreach ($orders as $day => $total) {
            $ordersPerDay[$day - 1] = $total;
        }

        return view('admin.dashboard', compact('ordersPerDay'));
    }

//                          PHẦN Product

    public function products(Request $request)
    {
        $search = $request->input('search_product');

        $products = Product::query()
            ->when($search, function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('brand', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('admin.products', compact('products', 'search'));
    }

    public function addProduct(Request $req)
    {
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = 'f' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/products'), $filename);
            $imagePath = 'img/products/' . $filename;
        } else {
            $imagePath = null;
        }

        Product::create([
            'name' => $req->name,
            'brand' => $req->brand,
            'price' => $req->price,
            'image' => $imagePath,
            'description' => $req->description,
            
        ]);

        return back()->with('success', 'Thêm sản phẩm thành công!');
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
        return back()->with('succes', 'Đã xóa sản phẩm thành công!');
    }

    public function updateProduct(Request $request, $id)
        {
            $product = Product::findOrFail($id);

            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->price = $request->price;
            $product->description = $request->description;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = 'f' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/products'), $filename);
                $product->image = 'img/products/' . $filename;
            }

            $product->save();
            return redirect()->back()->with('success', 'Sửa sản phẩm thành công!');
        }

//                          PHẦN USER

    public function users()
    {
        $users = User::orderBy('user_id', 'DESC')->get();
        return view('admin.users', compact('users'));
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);

        $currentUser = Session::get('user');

            if ($user->user_id === $currentUser->user_id) 
            {
                return back()->with('success', 'Bạn không thể thay đổi vai trò của chính mình!');
            }

        $user->role = $user->role === 'admin' ? 'customer' : 'admin';
        $user->save();

        return back()->with('success', 'Vai trò đã được thay đổi thành công!');
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'Đã xóa người dùng thành công!');
    }

    
// phần order
    public function orders(Request $req)
    {
        $search = $req->search_user;

        $orders = Order::select('orders.*')
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('orders.username', 'LIKE', "%$search%") 
                    ->orWhere('orders.full_name', 'LIKE', "%$search%") 
                    ->orWhere('orders.email', 'LIKE', "%$search%"); 
            });
        })
        ->orderBy('orders.created_at', 'DESC')
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

        return view('admin.orders', compact('orders', 'orderItems', 'search'));
    }

    public function confirmOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return back()->with('error', 'Order not found.');
        }

        $order->status = 'confirmed';
        $order->save();

        return back()->with('success', 'Order confirmed.');
    }
}
