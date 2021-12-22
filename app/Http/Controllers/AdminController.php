<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:8',
        ]);

            $admin = Admin::create([
                    'name' => $validatedData['name'],
                        'email' => $validatedData['email'],
                        'password' => Hash::make($validatedData['password']),
            ]);

        $token = $admin->createToken('auth_token')->plainTextToken;

            return response()->json([
                    'access_token' => $token,
                        'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email'))) {
         return response()->json([
        'message' => 'Invalid login details'
                ], 401);
            }

        $admin = Admin::where('email', $request['email'])->firstOrFail();

        $token = $admin->createToken('auth_token')->plainTextToken;

         return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
    ]);
    }
    public function me(Request $request)
    {
         return $request->admin();
    }
    // Search method to get all our Admins 
    public function search($name)
    {
        return Admin::where("name","like","%".$name."%")->get();
    }
}
