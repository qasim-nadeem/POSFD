<?php

namespace App\Http\Controllers;

use App\Service\SupplierTransactionManager;
use App\Service\ProductManager;
use Illuminate\Http\Request;

class SupplierTransactionController extends Controller
{
    private $supplierManager;
    private $supplierTransactionManager;
    public function __construct(
        ProductManager $productManager,
        SupplierTransactionManager $transactionManager
    )
    {
        $this->ProductManager = $productManager;
        $this->SupplierTransactionManager = $transactionManager;
    }


    public function addSupplierTransaction()
    {
        $products = $this->ProductManager->getAllProducts();
        return view('supplier.add_transactions',
            [
                'products' => $products
            ]
        );
    }

    //
    public function addTransaction(Request $request)
    {   
        $response = $this->SupplierTransactionManager->addTransactionProducts($request);
        return response()->json($response);
    }
}
