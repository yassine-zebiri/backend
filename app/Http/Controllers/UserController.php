<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class UserController extends Controller
{
    //
    public function create_user(Request $request){
                        
      $formFields=$request->validate([
            'first_name'        => 'required|string|min:3|max:255',
            'last_name'         => 'required|string|min:3|max:255',
            'email'             => 'required|email|unique:users,email',
            'email_verified_at' => 'nullable|date',
            'password'          => 'required|string|min:6',
            'role'              => 'required|in:Tourist,Historians,Tourism_Agencies,Investors,Ecommerce,Admin'
        ]);
   
         $user = User::create([
            'first_name'        => $formFields['first_name'],
            'last_name'         => $formFields['last_name'],
            'email'             => $formFields['email'],
            'email_verified_at' => $formFields['email_verified_at'] ?? null,
            'password'          => Hash::make($formFields['password']),
            'role'             => $formFields['role'],
        ]);
     
        $user->profile()->create([]);
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        Mail::to($user->email)->send(new VerifyEmail($url));

        return response()->json(['message' => 'User created'], 201);
        
    }
    public function login(Request $request){
        $form=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);
        $user=User::where('email',$form['email'])->first();
        if(!$user || !Hash::check($form['password'],$user->password) ){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }
    public function profile(Request $request){
        $user = $request->user()->load('profile');
        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'logout ...',
        ]);
    }
}
