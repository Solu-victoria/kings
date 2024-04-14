<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'receipt' => ['required', 'mimes:jpg,jpeg,png', 'max:5120'],

        ], [
            'receipt.mimes' => 'Image formats allowed are jpg,jpeg,png',
            'receipt.max' => 'Image size must be less than 5 MB'
        ]);

        $newImageName = env('APP_URL'). '/images/'. time() . '-' . trim($request->receipt->getClientOriginalName());
        $request->receipt->move(public_path('images'), $newImageName);

        $validatedData = array();
        $validatedData['receipt'] = $newImageName;
        $validatedData['user_id'] = Auth::user()->id;
        $order = Order::create($validatedData);

        $cart_items = Cart_item::where('user_id', Auth::user()->id)->get();
        $total = 0;
        $quantities = $request->quantity;
        foreach ($cart_items as $cart_item) {
            $total += ($cart_item->food->price * $cart_item->quantity);
            $data = array();
            $data['order_id'] = $order->id;
            $data['food_id'] = $cart_item->food->id;
            $data['quantity'] = $cart_item->quantity;
            
            Order_item::create($data);
            $cart_item->delete();
        }
        $order->update(['total' => $total]);
        return view('successful');
    }
}
