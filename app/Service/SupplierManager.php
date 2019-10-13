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
}