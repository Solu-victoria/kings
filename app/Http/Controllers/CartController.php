<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart_item;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function create() {
        $cart = Cart_item::where('user_id', Auth::user()->id)->get();
        return view('cart')->with('cart', $cart);
    }

    public function store(Request $request)
    {
       $validatedData = $request->all();
       $foodExistsInCart = Cart_item::where('food_id', $request->food_id)->first();
       if ($foodExistsInCart) {
        return redirect()->back()->with('message_cart', 'You have already added this food item to cart!' );
       }
       Cart_item::create($validatedData);
       return redirect()->back()->with('message_cart', 'You have successfully added a food item to cart!' );
    }

    public function remove(Request $request) {
        $cart = Cart_item::find($request->cart_item_id);
        $cart->delete();
        return redirect()->back()->with('message_cart', "\"{$cart->food->fname}\" removed from cart" );
    }

    public function update(Request $request) {
        $cart = Cart_item::find($request->cart_item_id);
        $cart->update(['quantity' => $request->quantity]);
        return redirect()->back()->with('message_cart', "Quantity updated for \"{$cart->food->fname}\"" );
    }
}
