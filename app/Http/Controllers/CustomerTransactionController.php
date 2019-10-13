<?php

namespace App\Http\Controllers;

use App\Service\CustomerTransactionManager;
use App\Service\ProductManager;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    private $productManager;
    private $customerTransactionManager;
    public function __construct(
        ProductManager $productManager,
        CustomerTransactionManager $transactionManager
    )
    {
        $this->productManager = $productManager;
        $this->customerTransactionManager = $transactionManager;
    }

    //
    public function addCustomerTransaction()
    {
        $products = $this->productManager->getAllProducts();
        return view('customer.transaction.add_transactions',
            [
                'products' => $products
            ]
        );
    }

    //
    public function addTransaction(Request $request)
    {
        $response = $this->customerTransactionManager->addTransactionProducts($request);
        return response()->json($response);
    }
}
