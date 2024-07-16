<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string|max:255',
            'storage_capacity' => 'required|string|max:255',
            'color_id' => 'exists:colors,id'
        ]);

        $product = Product::create([
            'model_name' => $request->model_name,
            'storage_capacity' => $request->storage_capacity,
            'color_id' => $request->color_id
        ]);

        return response()->json(['message' => "Product added successfully"]);
    }
}
