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
}