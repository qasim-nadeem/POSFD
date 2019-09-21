<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Service\ProductManager;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productManager;




    public function __construct(ProductManager $productManager)
    {
        $this->productManager = $productManager;
    }




    /*
     * Display add/update product form
     */
    public function addProduct()
    {
        return view('product.add_product');
    }




    /*
     * Post add/update product form
     */
    public function addProductAction(ProductRequest $request)
    {
        $request->validated();

        $this->productManager->AddProduct($request);

        return redirect()->back()
            ->withInput([])
            ->with('success', 'Product added into inventory')
            ->withInput($request->all());
    }
}
