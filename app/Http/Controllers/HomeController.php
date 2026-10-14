<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if ($q === '') {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'like', '%' . $q . '%')->get();
        }

        return view('home', compact('products', 'q'));
    }
}
