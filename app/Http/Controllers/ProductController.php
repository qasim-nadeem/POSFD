<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Service\ProductManager;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productManager;


    /*
     * product constructor for injections
     */
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



    /*
     * show update product form
     */
    public function updateProduct($id)
    {
        $product = $this->productManager->findProductById($id);

        return view('product.update_product',
            [
                'product' => $product
            ]
        );
    }

    /*
     * update product post request
     */
    public function updateProductAction(ProductRequest $request,$id)
    {
        $product = $this->productManager->updateProduct($request, $id);

        return redirect()
            ->route('product.update',['id' => $id])
            ->with('success', 'Product updated Successfully')
            ->withInput($request->all());
    }


    /*
     * show all products in products table
     */
    public function showAllProducts()
    {
        $products = $this->productManager->getAllProducts();
        return view('product.show_all_products',
            [
                'products' => $products
            ]
        );
    }

    /*
     * return data of a single product in json format
     */
    public function productDataByIdInJson($id)
    {
        $data = $this->productManager->getProductDataInJson($id);

        return response()->json($data);
    }
}
