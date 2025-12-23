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

        $product = Product::create([
            'name' => $req->name,
            'brand' => $req->brand,
            'price' => $req->price,
            'image' => $imagePath,
            'description' => $req->description,
     
        ]);

        return redirect()->to(
            route('admin.products') . '#product-' . $product->product_id
        )->with('success', 'Thêm thành công!');
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
            return redirect()->to(route('admin.products') . '#product-' . $product->product_id)->with('success', 'Cập nhập thành công!');
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

        $orders = Order::with('items.product')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('username', 'LIKE', "%$search%")
                        ->orWhere('full_name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                });
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.orders', compact('orders', 'search'));
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
