<?php


namespace App\Service;

use App\CustomerTransactions;
use App\CustomerTransactionsProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfitFilterManager
{

    public function filterProfitByDates(Request $request)
    {

        $current_date = date('Y/m/d');
        $get_data_daily = CustomerTransactions::select(['id','amount_paid'])->where('created_at', '>=', $current_date)->sum('amount_paid');
        $get_data_weekly = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next sunday')->endOfDay(),])->sum('amount_paid');
        $get_data_monthly = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),])->sum('amount_paid');
        $get_profit_daily = CustomerTransactionsProduct:: select(['id','profit'])->where('created_at', '>=', $current_date)->sum('profit');
        $get_profit_weekly =  CustomerTransactionsProduct::select(['id','profit'])->whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next sunday')->endOfDay(),])->sum('profit');
        $get_profit_monthly = CustomerTransactionsProduct::select(['id','profit'])->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),])->sum('profit');


        $data['daily'] = $get_data_daily;
        $data['weekly'] = $get_data_weekly;
        $data['monthly'] = $get_data_monthly;
        $data['daily_profit'] = $get_profit_daily;
        $data['weekly_profit'] = $get_profit_weekly;
        $data['monthly_profit'] = $get_profit_monthly;

        $dateFrom = Carbon::parse($request->all()['date-from']);
        $dateTo = Carbon::parse($request->all()['date-to']);
        $result = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
            $dateFrom->subDay(),
            $dateTo->addDay(),])->sum('amount_paid');

        $data['total_profit'] = $result;

        return $data;
    }
}
