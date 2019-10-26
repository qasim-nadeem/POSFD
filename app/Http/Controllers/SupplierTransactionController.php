<?php

namespace App\Http\Controllers;

use App\Service\SupplierTransactionManager;
use App\Service\ProductManager;
use App\Service\SupplierManager;
use Illuminate\Http\Request;

class SupplierTransactionController extends Controller
{
    private $supplierManager;
    private $supplierTransactionManager;
    public function __construct(
        ProductManager $productManager,
        SupplierTransactionManager $transactionManager, SupplierManager $suppliermanager
    )
    {
        $this->middleware('auth');
        
        $this->ProductManager = $productManager;
        $this->SupplierManager = $suppliermanager;
        $this->SupplierTransactionManager = $transactionManager;
        
    }


    public function addSupplierTransaction()
    {
        $products = $this->ProductManager->getAllProducts();
        $suppliers = $this->SupplierManager->getAllSuppliers();
        return view('supplier.add_transactions',
            [
                'products' => $products,
                'suppliers' => $suppliers
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
