<?php


namespace App\Service;


use App\SupplierTransactions;
use App\SupplierTransactionsProduct;
use Illuminate\Http\Request;

class SupplierTransactionManager
{
    public function addTransaction(Request $request)
    {
        $transactionData = $request->get('transaction');
        $supplierTransaction = new SupplierTransactions();
        $supplierTransaction->supplier_id = null;
        $supplierTransaction->amount_paid = $this->getTransactionTotal($transactionData);
        $supplierTransaction->to_be_paid = 0;

        if($supplierTransaction->save())
            return $supplierTransaction->id;
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
                $transactionProduct = new SupplierTransactionsProduct();
                $transactionProduct->transaction_id = $transactionId;
                $transactionProduct->supplier_id = null;
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
