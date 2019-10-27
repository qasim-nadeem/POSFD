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

    public function allSupplierTransaction()
    {
        $transactions = $this->SupplierTransactionManager->getAllSupplierTransactions();
        return view('supplier.all_transactions',
            [
                'transactions' => $transactions
            ]
        );
    }

        public function detailSupplierTransaction(Request $request, $transaction_id, $supplier_id = null)
    {
        $transactionDetail = $this->SupplierTransactionManager->getTransactionDetail($supplier_id, $transaction_id);
        return view('supplier.transaction_details',
            [
                'transactionDetails' => $transactionDetail
            ]
        );

    }
}
