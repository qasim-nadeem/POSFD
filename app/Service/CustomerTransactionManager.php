<?php


namespace App\Service;


use App\Customer;
use App\CustomerTransactions;
use App\CustomerTransactionsProduct;
use Illuminate\Http\Request;

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
            {
                $transactionProduct = new CustomerTransactionsProduct();
                $transactionProduct->transaction_id = $transactionId;
                $transactionProduct->customer_id = ($customer) ? $customer->id : $customer;
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
}
