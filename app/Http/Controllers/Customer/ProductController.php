<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController
{

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $size = $request->input('size');
        $quantity = (int)$request->input('quantity', 1);

        $user = Session::get('user');

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->user_id]
        );

        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product->product_id)
            ->where('size', $size)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product->product_id,
                'size' => $size,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('customer.sproduct', $id)
            ->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');

}
}