<?php


namespace App\Service;


use App\CustomerTransactions;
use App\CustomerTransactionsProduct;
use Illuminate\Http\Request;

class CustomerTransactionManager
{
    public function addTransaction(Request $request)
    {
        $transactionData = $request->get('transaction');
        $customerTransaction = new CustomerTransactions();
        $customerTransaction->customer_id = null;
        $customerTransaction->amount_paid = $this->getTransactionTotal($transactionData);
        $customerTransaction->to_be_paid = 0;

        if($customerTransaction->save())
            return $customerTransaction->id;
        else
            return false;
    }

    public function addTransactionProducts(Request $request)
    {
        $transactionId = $this->addTransaction($request);
        if($transactionId)
        {
            $transactionData = $request->get('transaction');
            foreach ($transactionData as $product)
            {
                $transactionProduct = new CustomerTransactionsProduct();
                $transactionProduct->transaction_id = $transactionId;
                $transactionProduct->customer_id = null;
                $transactionProduct->product_id = $product[0];
                $transactionProduct->quantity = $product[1];
                $transactionProduct->price_per_unit = $product[2];
                $transactionProduct->discounted_price_per_unit = 0;
                $transactionProduct->save();
            }

            return true;
        }
        else
            return false;
    }

    public function getTransactionTotal($transactionData)
    {
        $total = 0;
        foreach ($transactionData as $product)
        {
            $total += (int)$product[1] * (int)$product[2];
        }

        return $total;
    }
}
