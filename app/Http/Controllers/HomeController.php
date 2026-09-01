<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $cats = Cat::where('status', 'available')->latest()->take(4)->get();
        $products = Product::latest()->take(4)->get();

        return view('home', compact('cats', 'products'));
    }
}