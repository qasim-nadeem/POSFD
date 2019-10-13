<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Service\SupplierManager;
use App\supplier;

class SupplierController extends Controller
{
    private $supplierManager;


        public function __construct(SupplierManager $supplierManager)
    {
        $this->supplierManager = $supplierManager;
    }


    public function addsupplier()
    {
        return view('supplier.add_supplier');
    }

    public function addSupplierAction(SupplierRequest $request)
    {
        $request->validated();

        $this->supplierManager->AddSupplier($request);

        return redirect()->back()
            ->withInput([])
            ->with('success', 'Supplier added into inventory')
            ->withInput($request->all());

    }
}
