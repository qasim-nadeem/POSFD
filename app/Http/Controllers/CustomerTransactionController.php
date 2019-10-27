<?php

namespace App\Http\Controllers;

use App\Service\CustomerTransactionManager;
use App\Service\ProductManager;
use Illuminate\Http\Request;
use App\CustomerTransactions;
use Carbon;
class CustomerTransactionController extends Controller
{
    private $productManager;
    private $customerTransactionManager;
    public function __construct(
        ProductManager $productManager,
        CustomerTransactionManager $transactionManager
    )
    {
        $this->middleware('auth');
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
    public function allCustomerTransaction()
    {
        $transactions = $this->customerTransactionManager->getAllCustomerTransactions();
        return view('customer.transaction.all_transactions',
            [
                'transactions' => $transactions
            ]
        );
    }

    //
    public function detailCustomerTransaction(Request $request, $transaction_id, $customer_id = null)
    {
        $transactionDetail = $this->customerTransactionManager->getTransactionDetail($customer_id, $transaction_id);
        return view('customer.transaction.transaction_details',
            [
                'transactionDetails' => $transactionDetail
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
