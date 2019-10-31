<?php

namespace App\Http\Controllers;

use App\Service\ProfitFilterManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FilterController extends Controller
{
    private $profitFilterManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfitFilterManager $profitFilterManager)
    {
        $this->profitFilterManager = $profitFilterManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profitFilter(Request $request)
    {
        $data = $this->profitFilterManager->filterProfitByDates($request);

        return view('dashboard.index', $data);
    }
}
