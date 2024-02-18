<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function allProducts(){
        $product = Product::orderBy('id','DESC')->get();  
        return response()->json(
            ['product'=>$product
        ],200
        );
        // return response()->json(['product' => $product], 200);
    }
}
