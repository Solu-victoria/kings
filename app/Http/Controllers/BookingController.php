<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;

class BookingController extends Controller
{
    public function create() {
        return view('booking');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'date_and_time' => ['required', 'date', 'after:now'],
            'no_of_people' => ['required', 'string'],
            'request' => ['max:1000']

        ]);

            $validatedData = $request->all();
            Booking::create($validatedData);
            return redirect()->back()->with('message', 'You have successfully booked a table!' );
        
    }
}
