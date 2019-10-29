<?php
/**
 * Created by PhpStorm.
 * User: Qasim Nadeem
 * Date: 21-Sep-19
 * Time: 2:43 PM
 */
namespace App\Service;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductManager
{
    public function AddProduct(ProductRequest $request)
    {
        $productData = $request->all();
        $productData['total_quantity'] = $request->quantity;
        return Product::create($productData);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function findProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $productData = $request->all();
        unset($productData['_token']);
        unset($productData['Add']);
        $productData['total_quantity'] = $request->quantity;

        return Product::updateOrCreate(['id' => $id],$productData);
    }

    public function getProductDataInJson($id)
    {
        $product = $this->findProductById($id);

        $productArray = [
            'id' => $product->id,
            'quantity' => $product->quantity,
            'price' => $product->price_per_unit,
            'purchase_price' => $product->purchase_price
        ];

        return $productArray;
    }
}