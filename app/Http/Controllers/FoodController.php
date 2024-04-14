<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function create() {
        $breakfast = Food::where('category', 'Breakfast')->get();
        $lunch = Food::where('category', 'Lunch')->get();
        $dinner = Food::where('category', 'Dinner')->get();
        return view('menu', compact('breakfast', 'lunch', 'dinner'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'fname' => ['required', 'string'],
            'category' => ['required', 'string'],
            'fdesc' => ['required', 'max:1000'],
            'price' => ['required', 'integer'],
            'image' => ['required', 'mimes:jpg,jpeg,png', 'max:5120'],

        ], [
            'image.mimes' => 'Image formats allowed are jpg,jpeg,png',
            'image.max' => 'Image size must be less than 5 MB'
        ]);

        $newImageName = time() . '-' . $request->fname . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        $validatedData = $request->all();
        $validatedData['image'] = $newImageName;
        Food::create($validatedData);
        return redirect()->back()->with('message', 'You have successfully added to the food menu!' );
        
    }
}

