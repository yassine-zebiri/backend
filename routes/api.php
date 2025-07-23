<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\PasswordResetController;



Route::post('/user/create',[UserController::class,'create_user']);

Route::post('/reverse-me', function (Request $request) {
  dd($request);
  $reversed = strrev($request->input('reverse_this'));
   return response()->json(['message' => 'User created'], 201);

});
Route::post('/log-in',[UserController::class,'login']);
Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);
Route::middleware('auth:sanctum')->post('/log-out', [UserController::class, 'logout']);

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = \App\Models\User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->email))) {
        abort(403);
    }

    $user->email_verified_at = now();
    $user->save();

    return response()->json(['message' => 'تم تأكيد البريد بنجاح']);
})->name('verification.verify');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
