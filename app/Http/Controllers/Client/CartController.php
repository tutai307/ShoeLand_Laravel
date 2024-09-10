<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Lấy hoặc tạo giỏ hàng.
     *
     * @return \App\Models\Cart
     */
    protected function getOrCreateCart()
    {
        $userId = auth()->id(); // Lấy ID người dùng nếu đã đăng nhập
        $cartId = request()->cookie('cart_id'); // Lấy cart_id từ cookie

        if ($userId) {
            // Nếu người dùng đã đăng nhập
            $cart = Cart::where('user_id', $userId)->first();

            if ($cart) {
                // Nếu đã có giỏ hàng gắn với tài khoản người dùng
                if ($cartId && $cart->id !== $cartId) {
                    // Xử lý khi giỏ hàng trong cookie khác với giỏ hàng trong DB
                    $tempCart = Cart::find($cartId);

                    if ($tempCart) {
                        // Chuyển các mặt hàng từ giỏ hàng tạm thời vào giỏ hàng chính
                        foreach ($tempCart->cartItems as $item) {
                            $cart->cartItems()->updateOrCreate(
                                ['product_id' => $item->product_id, 'size_id' => $item->size_id],
                                ['quantity' => $item->quantity, 'unit_price' => $item->unit_price]
                            );
                        }

                        // Xóa giỏ hàng tạm thời
                        $tempCart->delete();
                    }

                    // Cập nhật lại cookie với cart_id hiện tại
                    cookie()->queue(cookie('cart_id', $cart->id, 60 * 24 * 7)); // Cookie tồn tại 7 ngày
                }
            } else {
                // Nếu không có giỏ hàng nào gắn với tài khoản người dùng, kiểm tra giỏ hàng tạm thời trong cookie
                if ($cartId) {
                    $cart = Cart::find($cartId);
                    if ($cart) {
                        // Gắn giỏ hàng tạm thời vào tài khoản người dùng
                        $cart->user_id = $userId;
                        $cart->save();
                    }
                }

                if (!$cart) {
                    // Nếu không có giỏ hàng nào trong cookie, tạo mới giỏ hàng
                    $cart = Cart::create(['user_id' => $userId]);
                }
            }
        } else {
            // Nếu người dùng chưa đăng nhập
            $cart = $cartId ? Cart::find($cartId) : null;

            if (!$cart) {
                // Tạo giỏ hàng mới và lưu cart_id vào cookie
                $cart = Cart::create();
                cookie()->queue(cookie('cart_id', $cart->id, 60 * 24 * 7)); // Cookie tồn tại 7 ngày
            }
        }

        return $cart;
    }

    public function addToCart(Request $request)
    {
        $cart = $this->getOrCreateCart();
        // Kiểm tra sự tồn tại của sản phẩm
        $product = Product::findOrFail($request->product_id);

        // Thêm sản phẩm vào giỏ hàng
        $cart->cartItems()->updateOrCreate(
            [
                'product_id' => $product->id,
                'size_id' => $request->size,
            ],
            [
                'quantity' => $request->quantity,
                'unit_price' => $product->price,
            ]
        );

        return redirect()->route('cart.view')->with('msg', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function viewCart()
    {
        $cart = $this->getOrCreateCart();
        $cartItems = $cart ? $cart->cartItems : collect();

        $categories = Category::all();
        $user = Auth::user();
        $events = Event::all();
        $products = Product::with(['mainImage', 'event'])->get();

        // Lấy các sản phẩm của Adidas
        $adidasCategory = Category::where('name', 'Adidas')->first();
        $adidasProducts = $adidasCategory ? Product::where('category_id', $adidasCategory->id)->get() : collect();

        return view('client.carts.index', compact('cartItems', 'events', 'categories', 'products', 'adidasProducts', 'user'));
    }
    public function updateQuantity(Request $request)
    {
        $itemId = $request->id;
        $increase = $request->increase;

        // Tìm item giỏ hàng
        $cartItem = CartItem::find($itemId);

        if ($cartItem) {
            // Tăng hoặc giảm số lượng dựa trên yêu cầu
            if ($increase) {
                $cartItem->quantity += 1;
            } else {
                if ($cartItem->quantity > 1) { // Ngăn chặn số lượng nhỏ hơn 1
                    $cartItem->quantity -= 1;
                }
            }

            $cartItem->save();

            // Tính tổng giá mới cho item này
            $newTotalPrice = $cartItem->quantity * $cartItem->unit_price;
            $newTotalPriceFormatted = number_format($newTotalPrice, 0, ',', '.') . ' đ';

            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity,
                'newTotalPriceFormatted' => $newTotalPriceFormatted,
            ]);
        }

        return response()->json(['success' => false], 404);
    }


    public function removeFromCart($id)
    {
        $cart = $this->getOrCreateCart();
        $cartItem = CartItem::find($id);

        if ($cartItem && $cartItem->cart_id === $cart->id) {
            $cartItem->delete();
            return redirect()->route('cart.view')->with('msg', 'Sản phẩm đã được xoá khỏi giỏ hàng!');
        }
    }
}
