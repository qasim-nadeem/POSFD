<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerTransactions;
use Carbon;

class DashboardController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    	
    }


    public function index()
    {	
            $current_date = date('Y/m/d');
            $get_data_daily = CustomerTransactions::select(['id','amount_paid'])->where('created_at', '>=', $current_date)->sum('amount_paid');
            $get_data_weekly = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
                            Carbon\Carbon::parse('last monday')->startOfDay(),
                            Carbon\Carbon::parse('next sunday')->endOfDay(),])->sum('amount_paid');
            $get_data_monthly = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
                            Carbon\Carbon::now()->startOfMonth(),
                            Carbon\Carbon::now()->endOfMonth(),])->sum('amount_paid');
    	$data['daily'] = $get_data_daily;
    	$data['weekly'] = $get_data_weekly;
    	$data['monthly'] = $get_data_monthly;
        return view('dashboard.index', $data);
    }

    // public function calculate_daily_sale(){
          
    //         $current_date = date('Y/m/d');
    //         $get_data = CustomerTransactions::select(['id','amount_paid'])->where('created_at', '>=', $current_date)->sum('amount_paid');

    //         return $get_data;
    // }

    // public function calculate_weekly_sales(){
    
    //         $get_data = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
    //                         Carbon\Carbon::parse('last monday')->startOfDay(),
    //                         Carbon\Carbon::parse('next sunday')->endOfDay(),])->sum('amount_paid');
    //         return $get_data;
            
    // }

    // public function calculate_monthly_sales(){
    //        $get_data = CustomerTransactions::select(['id','amount_paid'])->whereBetween('created_at', [
    //                         Carbon\Carbon::now()->startOfMonth(),
    //                         Carbon\Carbon::now()->endOfMonth(),])->sum('amount_paid');

    //         return $get_data;
    // }
}
