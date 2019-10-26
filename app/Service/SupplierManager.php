<?php
/**
 * Created by PhpStorm.
 * User: Qasim Nadeem
 * Date: 21-Sep-19
 * Time: 2:43 PM
 */
namespace App\Service;

use App\Http\Requests\SupplierRequest;
use App\supplier;

class SupplierManager
{
    public function AddSupplier(SupplierRequest $request)
    {
        $supplierData = $request->all();
        $supplierData['name'] = $request->supplier_name;

        return supplier::create($supplierData);
    }

      public function getAllSuppliers()
    {
        return supplier::all();
    }

     public function findProductById($id)
    {
        return supplier::findOrFail($id);
    }

    public function updateSupplier(SupplierRequest $request, $id)
    {
        $supplierData = $request->all();
        unset($supplierData['_token']);
        unset($supplierData['Add']);
        $supplierData['name'] = $request->supplier_name;
        return supplier::updateOrCreate(['id' => $id],$supplierData);
    }

    public function getProductDataInJson($id)
    {
        $product = $this->findProductById($id);

        $productArray = [
            'id' => $product->id,
            'quantity' => $product->quantity,
            'price' => $product->price_per_unit
        ];

        return $productArray;
    }
}