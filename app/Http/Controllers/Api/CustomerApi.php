<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerApi extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();
        return response()->json(['customers' => $customers], 200);
    }

}
