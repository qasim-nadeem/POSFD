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

        public function showAllSuppliers()
    {
        $suppliers = $this->supplierManager->getAllSuppliers();
        return view('supplier.show_all_suppliers',
            [
                'suppliers' => $suppliers
            ]
        );
    }

        public function updateSupplier($id)
    {
        $supplier = $this->supplierManager->findProductById($id);

        return view('supplier.update_supplier',
            [
                'supplier' => $supplier
            ]
        );
    }

    /*
     * update product post request
     */
    public function updateSupplierAction(SupplierRequest $request,$id)
    {
        $supplier = $this->supplierManager->updateSupplier($request, $id);

        return redirect()
            ->route('supplier.update',['id' => $id])
            ->with('success', 'Product updated Successfully')
            ->withInput($request->all());
    }

}
