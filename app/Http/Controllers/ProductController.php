<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.product');
    }

    public function shop()
    {
        return view('home.shop');
    }

    public function cart()
    {
        return view('home.cart');
    }

    public function checkout()
    {
        return view('home.checkout');
    }

    public function pay()
    {
        return view('home.pay');
    }
}
