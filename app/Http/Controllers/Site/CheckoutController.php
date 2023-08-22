<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('site.pages.checkout');
    }

    public function store(){
        return redirect()->route('home')->with('message', 'Order placed successfully.');
    }
}
