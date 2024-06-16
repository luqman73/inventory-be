<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function staff()
    {
        $staff = User::where('role', 'staff')->get();

        return response()->json($staff);
    }
}
