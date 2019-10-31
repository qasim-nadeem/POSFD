<?php


namespace App\Service;


use App\Customer;
use App\CustomerTransactions;
use App\CustomerTransactionsProduct;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerTransactionManager
{



    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function addTransaction(Request $request, $customer)
    {
        $transactionData = $request->get('transaction');
        $customerTransaction = new CustomerTransactions();
        $customerTransaction->customer_id = ($customer) ? $customer->id : $customer;
        $customerTransaction->amount_paid = $this->getTransactionTotal($transactionData);
        $customerTransaction->to_be_paid = 0;

        if($customerTransaction->save())
            return $customerTransaction->id;
        else
            return false;
    }




    /**
     * @param Request $request
     * @return bool
     */
    public function addTransactionProducts(Request $request)
    {
        $customer = $this->addCustomer($request->get('customerInfo'));

        $transactionId = $this->addTransaction($request, $customer);
        if($transactionId)
        {
            $transactionData = $request->get('transaction');
            foreach ($transactionData as $product)
            {   $profit = Product:: find($product[0]);

                $transactionProduct = new CustomerTransactionsProduct();
                $transactionProduct->transaction_id = $transactionId;
                $transactionProduct->customer_id = ($customer) ? $customer->id : $customer;
                $transactionProduct->product_id = $product[0];
                $transactionProduct->quantity = $product[2];
                $transactionProduct->price_per_unit = $product[1];
                $transactionProduct->discounted_price_per_unit = 0;
                $transactionProduct->profit = ($product[1] - $profit['purchase_price']) * $product[2];
                $transactionProduct->created_at = Carbon::now();
                $this->updateProduct($product[0], $product[2]);
                $transactionProduct->save();
            }

            return true;
        }
        else
            return false;
    }



    /**
     * @param $transactionData
     * @return float|int
     */
    public function getTransactionTotal($transactionData)
    {
        $total = 0;
        foreach ($transactionData as $product)
        {
            $total += (int)$product[1] * (int)$product[2];
        }

        return $total;
    }




    /**
     * @param array $customerInfo|null
     * @return Customer|null
     */
    public function addCustomer(?array $customerInfo)
    {

        if($customerInfo)
        {
            $customer = Customer::where('mobile_no', $customerInfo[1])->first();
            if(!$customer)
            {
                $customer = new Customer();
            }
            $customer->name = $customerInfo[0];
            $customer->mobile_no = $customerInfo[1];
            $customer->address = $customerInfo[2];
            $customer->save();
            return $customer;
        }
        else
        {
            return null;
        }
    }


    /**
     * @param $productId
     * @param $quantity
     */
    public function updateProduct($productId, $quantity)
    {
        $product = Product::find($productId);
        $product->quantity = $product->quantity - $quantity;
        $product->save();
    }

    /**
     * @return CustomerTransactions[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCustomerTransactions()
    {
        $transactions = DB::table('customer_transactions')
            ->leftJoin('customers', 'customer_transactions.customer_id','=', 'customers.id')
            ->select('customer_transactions.*','customers.name as customer_name')
            ->get();

        return $transactions;
    }

    public function getTransactionDetail($customer_id, $transaction_id)
    {
        $transactionDetail = DB::table('customer_transactions_products')
            ->join('products','customer_transactions_products.product_id','=', 'products.id')
            ->join('customer_transactions','customer_transactions_products.transaction_id','=', 'customer_transactions.id')
            ->leftJoin('customers', 'customer_transactions_products.customer_id','=', 'customers.id')
            ->where('customer_transactions_products.transaction_id',$transaction_id)
            ->select('customer_transactions_products.*',
                'products.name as product_name',
                'customers.name as customer_name',
                'customers.mobile_no as phone',
                'customers.address as address',
                'customer_transactions.amount_paid as total_amount_paid'
            )
            ->get();

        $retval = [];
        if($customer_id && $transactionDetail)
        {
            $customerInfo['name'] = $transactionDetail[0]->customer_name;
            $customerInfo['phone'] = $transactionDetail[0]->phone;
            $customerInfo['address'] = $transactionDetail[0]->address;

            $retval['customerInfo'] = $customerInfo;
            $retval['totalAmount'] = $transactionDetail[0]->total_amount_paid;
        }
        else
        {
            $retval['customerInfo'] = null;
            $retval['totalAmount'] = $transactionDetail[0]->total_amount_paid;
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
