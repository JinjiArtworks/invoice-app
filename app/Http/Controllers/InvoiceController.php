<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use PhpParser\JsonDecoder;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('invoices.index');
    }
    public function create()
    {
        return view('invoices.create');
    }
    public function show()
    {
        // dd($id);
        return view('invoices.show');
    }
    public function edit()
    {
        return view('invoices.edit');
    }
}
