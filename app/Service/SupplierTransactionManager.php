<?php


namespace App\Service;

use App\SupplierTransactions;
use App\SupplierTransactionsProduct;
use Illuminate\Http\Request;
use App\Product;
use App\supplier;


class SupplierTransactionManager
{
    public function addTransaction(Request $request)
    {
        $transactionData = $request->get('transaction');
        $paid_amount = $request->get('paid_amount');
        $supplierTransaction = new SupplierTransactions();
        $supplierTransaction->supplier_id = $transactionData[0][0];
        $supplierTransaction->amount_paid = $paid_amount;
        $supplierTransaction->to_be_paid = $this->getTransactionTotal($transactionData) - $paid_amount;
        $updatebalance = supplier::find($transactionData[0][0]);
        $updatebalance->balance = $updatebalance->balance + $this->getTransactionTotal($transactionData) - $paid_amount;
        $updatebalance->save();
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
                $transactionProduct->supplier_id = $product[0];
                $transactionProduct->product_id = $product[1];
                $transactionProduct->quantity = $product[3];
                $transactionProduct->price_per_unit = $product[2];
                $transactionProduct->discounted_price_per_unit = 0;
                $this->updateProduct($product[1], $product[3]);
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
            $total += (int)$product[2] * (int)$product[3];
        }

        return $total;
    }

     public function updateProduct($productId, $quantity)
    {
        $product = Product::find($productId);
        $product->quantity = $product->quantity + $quantity;
        $product->total_quantity = $product->total_quantity + $quantity;
        $product->save();
    }
}
