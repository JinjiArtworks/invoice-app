<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductApi extends Controller
{
    public function index()
    {
        $products = Products::orderBy('id', 'DESC')->get();
        return response()->json(['products' => $products], 200);
    }

}
