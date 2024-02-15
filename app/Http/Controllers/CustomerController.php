<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function getAllCustomers(){
        $customer = Customer::orderBy('id','DESC')->get();
        return response()->json(['customers'=>$customer],200);
    }
}
