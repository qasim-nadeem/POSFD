<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addProduct()
    {
        return view('product.add_product');
    }

    public function addProductAction(Request $request)
    {
        dd($request);
    }
}
