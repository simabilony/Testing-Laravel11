<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class ProductController extends Controller
{
    public function index(): View
    {
        //$products = Product::all();
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }
}
