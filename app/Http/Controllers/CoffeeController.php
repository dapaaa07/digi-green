<?php

namespace App\Http\Controllers;

use App\Models\CoffeeProduct;
use Illuminate\View\View;

class CoffeeController extends Controller
{
    public function index(): View
    {
        $coffees = CoffeeProduct::where('is_available', true)->get();
        return view('coffee.index', compact('coffees'));
    }
}
