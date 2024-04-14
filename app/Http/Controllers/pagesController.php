<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\id_card_request;
use App\Models\User;
use App\Models\Food;
use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;

class pagesController extends Controller
{
    public function index(){
        $breakfast = Food::where('category', 'Breakfast')->get();
        $lunch = Food::where('category', 'Lunch')->get();
        $dinner = Food::where('category', 'Dinner')->get();
        return view('index', compact('breakfast', 'lunch', 'dinner'));
    }    

    public function about(){
        return view('about');
    } 

    public function contact(){
        return view('contact');
    } 

    public function checkout(){
        $cart_items = Cart_item::where('user_id', Auth::user()->id)->get();
        $total = 0;
        foreach ($cart_items as $cart_item) {
            $total += ($cart_item->food->price * $cart_item->quantity);
        }
        return view('checkout')->with('total',  $total);
    }

    public function service(){
        return view('service');
    }  

}
