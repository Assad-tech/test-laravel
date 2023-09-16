<?php

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('dashboard');
Route::get('frontend/about', function () {
    return view('frontend.about');
});
Route::get('frontend/we_do', function () {
    return view('frontend.we_do');
});
Route::get('frontend/contact', function () {
    return view('frontend.contact');
});
Route::get('frontend/portfolio', function () {
    return view('frontend.portfolio');
});

Route::get('push-notification', [NotificationController::class, 'index']);
Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('send.notification');


Route::middleware('AuthMiddleware')->group(function () {
    Route::get('auth/register', [AuthController::class, 'register'])->name('registerPage');
    Route::post('auth/register', [AuthController::class, 'registerProcess'])->name('registerProcess');
    Route::get('auth/verifyEmail/{token}', [AuthController::class, 'emaiVerify'])->name('emailVerify');

    Route::get('auth/login', [AuthController::class, 'login'])->name('loginPage');
    Route::post('auth/login', [AuthController::class, 'loginProcess'])->name('loginProcess');
    Route::get('auth/forgotPassword', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgotPasswordProcess', [ForgotPasswordController::class, 'forgotPasswordProcess'])->name('forgotPasswordProcess');
    Route::get('auth/password/reset-Password-Form/{user}', [PasswordResetController::class, 'showResetForm'])->name('showRestForm');
    Route::post('passwordResetProcess/{token}', [PasswordResetController::class, 'resetPassword'])->name('passwordResetProcess');


    Route::middleware('AdminAuth')->group(function () {
        Route::get('admin/admin-dashboard',[UserController::class,'index'])->name('AdminDashboard');
        Route::get('admin/createUser', [UserController::class, 'create'])->name('addUserPage');
        Route::post('admin/storeUser', [UserController::class, 'store'])->name('storeUserProcess');
        Route::get('admin/edit-user/{id}', [UserController::class, 'edit'])->name('editUser');
        Route::post('admin/update/{id}', [UserController::class, 'update'])->name('updateUser');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');

        // Posts
        Route::get('post/admin-index',[PostController::class,'index']);
        Route::get('post/admin-create',[PostController::class,'create']);
        Route::post('post/admin-store',[PostController::class,'store']);
        Route::get('post/admin-show/{id}',[PostController::class,'show']);
        Route::get('post/admin-edit/{id}',[PostController::class,'edit']);
        Route::post('post/admin-update/{id}',[PostController::class,'update']);
        Route::get('post/admin-delete/{id}',[PostController::class,'destroy']);
        
    });
    
    Route::middleware('V_AdminAuth')->group(function () {
        Route::get('v-admin/v-admin-dashboard',[UserController::class,'index'])->name('v-AdminDashboard');
        Route::get('v-admin/createUser', [UserController::class, 'create'])->name('addUserPAGE');
        Route::post('v-admin/createUser', [UserController::class, 'store'])->name('storeUser');
        Route::get('v-admin/edit-user/{id}', [UserController::class, 'edit'])->name('editUser');
        Route::post('update/{id}', [UserController::class, 'update'])->name('updateUser');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('deleteUser');
        
        Route::get('post/v_admin-index',[PostController::class,'index']);
        Route::get('post/v_admin-create',[PostController::class,'create']);
        Route::post('post/v_admin-store',[PostController::class,'store']);
        Route::get('post/v_admin-show/{id}',[PostController::class,'show']);
        Route::get('post/v_admin-edit/{id}',[PostController::class,'edit']);
        Route::post('post/v_admin-update/{id}',[PostController::class,'update']);
        Route::get('post/v_admin-delete/{id}',[PostController::class,'destroy']);
    });


    Route::middleware(['UserAuth'])->group(function () {
        Route::get('user/user-dashboard', function () {
            return view('user.user-dashboard');
        })->name('UserDashboard');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
