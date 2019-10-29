<?php


namespace App\Service;

use App\SupplierTransactions;
use App\SupplierTransactionsProduct;
use Illuminate\Http\Request;
use App\Product;
use App\supplier;
use DB;


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
                $update_product = Product:: find($product[1]);
                $transactionProduct = new SupplierTransactionsProduct();
                $transactionProduct->transaction_id = $transactionId;
                $transactionProduct->supplier_id = $product[0];
                $transactionProduct->product_id = $product[1];
                $transactionProduct->quantity = $product[3];
                $transactionProduct->price_per_unit = $product[2];
                $transactionProduct->discounted_price_per_unit = 0;
                $this->updateProduct($product[1], $product[3]);
                $transactionProduct->save();
                $update_product->purchase_price = $product[2];
                $update_product-> save();
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

    public function getAllSupplierTransactions()
    {
        $transactions = DB::table('supplier_transactions')
            ->leftJoin('suppliers', 'supplier_transactions.supplier_id','=', 'suppliers.id')
            ->select('supplier_transactions.*','suppliers.name as supplier_name')
            ->get();

        return $transactions;
    }

    public function getTransactionDetail($supplier_id, $transaction_id)
    {
        $transactionDetail = DB::table('supplier_transactions_products')
            ->join('products','supplier_transactions_products.product_id','=', 'products.id')
            ->join('supplier_transactions','supplier_transactions_products.transaction_id','=', 'supplier_transactions.id')
            ->leftJoin('suppliers', 'supplier_transactions_products.supplier_id','=', 'suppliers.id')
            ->where('supplier_transactions_products.transaction_id',$transaction_id)
            ->select('supplier_transactions_products.*',
                'products.name as product_name',
                'suppliers.name as supplier_name',
                'supplier_transactions.amount_paid as total_amount_paid',
                'supplier_transactions.to_be_paid as to_pay'
            )
            ->get();

        $retval = [];
        if($supplier_id && $transactionDetail)
        {
            $supplierInfo['name'] = $transactionDetail[0]->supplier_name;
            $retval['supplierInfo'] = $supplierInfo;
            $retval['totalAmount'] = $transactionDetail[0]->total_amount_paid;
            $retval['to_be_paid'] = $transactionDetail[0]->to_pay;

        }
        else
        {
            $retval['supplierInfo'] = null;
            $retval['totalAmount'] = $transactionDetail[0]->total_amount_paid;
            $retval['to_be_paid'] = $transactionDetail[0]->to_pay;

        }

        $productsDetails = [];
        foreach ($transactionDetail as $detail)
        {
            $productDetails['product_name'] = $detail->product_name;
            $productDetails['product_quantity'] = $detail->quantity;
            $productDetails['product_price'] = $detail->price_per_unit;
            $productDetails['total_item_price'] = $detail->quantity * (int)$detail->price_per_unit;

            $productsDetails[] = $productDetails;

        }
        $retval['productDetails'] = $productsDetails;

        return $retval;
    }
}
