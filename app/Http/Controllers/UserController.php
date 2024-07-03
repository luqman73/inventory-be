<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function staff()
    {
        $staff = User::where('role', 'staff')
            ->where('status','active')
            ->get();
        
        return response()->json($staff);
    }

    public function getStaffById($userId)
    {
        $staff = User::find($userId);

        if (!$staff) {
            return response()->json(['message' => 'Staff not found'], 404);
        }

        return response()->json($staff);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'staff'
        ]);

        return response()->json(['message' => 'Staff registered succesfully!']);
    }

    public function deactivateStaff($userId)
    {   
        $user = User::find($userId);
       
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
    
        $user->status = 'inactive';
        $user->save();
    
        return response()->json(['message' => 'User deactivated successfully.']);
    }

    public function updateStaff(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->userId,
        ]);

        $user = User::find($userId);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
    
            return response()->json(['message' => 'User updated successfully']);
        }

        return response()->json(['message' => 'User not found']);
    }
}
