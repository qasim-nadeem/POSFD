<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\supplier;

class SupplierController extends Controller
{
    public function addsupplier()
    {
        return view('supplier.add_supplier');
    }

    public function addSupplierAction(Request $request)
    {
        $data = $request->all();

        $savesupplier = new supplier();
        $savesupplier->name = $data['supplier_name'];
        $savesupplier->mobile_no = $data['mobile_no'];
        $savesupplier->address = $data['address'];
        $savesupplier->company_name = $data['company_name'];
        $savesupplier->balance = $data['balance'];
        $savesupplier->save();

        return redirect()->route('supplier.add');


    }
}
