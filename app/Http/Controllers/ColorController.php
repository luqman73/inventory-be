<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        return Color::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $color = Color::create([
            'name' =>  $request->name 
        ]);

        return response()->json(['message' => 'Color added successfully']);
    }
}
