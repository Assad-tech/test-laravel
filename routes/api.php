<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'registerProcess'])->name('registerProcess');
Route::post('login', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::post('verify-email', [AuthController::class, 'emaiVerify'])->name('emailVerify');
Route::post('forgot-password-process', [ForgotPasswordController::class, 'forgotPasswordProcess'])->name('forgotPasswordProcess');
Route::post('passwordResetProcess', [PasswordResetController::class, 'resetPassword'])->name('passwordResetProcess');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', function (Request $request) {
        if ($request->user()->role_id == 1) {
            return response()->json(['message' => 'Admin Dashboard!', 'user' => $request->user()]);
        }
        return response()->json(['message' => 'User Dashboard!', 'user' => $request->user()]);
    });
    Route::get('get-users', [UserController::class, 'index']);
    Route::patch('update-user/{id}', [UserController::class, 'update']);
    Route::get('delete-user/{user}', [UserController::class, 'destroy']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
