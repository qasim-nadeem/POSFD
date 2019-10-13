<?php

namespace App\Http\Controllers;

use App\Service\ProductManager;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    private $productManager;
    public function __construct(ProductManager $productManager)
    {
        $this->productManager = $productManager;
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
}
