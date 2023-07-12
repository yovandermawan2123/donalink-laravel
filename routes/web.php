<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignFrontController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::get('auth/redirect', [AuthController::class, 'redirectToProvider']);
Route::get('auth/callback', [AuthController::class, 'handleProviderCallback']);

Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/logout', [AuthController::class, 'logout']);



//FRONTEND
Route::get('/', function () {
    $campaigns = Campaign::get();
    return view('frontend.index', [
        'campaigns' => $campaigns,
    ]);
});
Route::get('/all-campaign', [CampaignFrontController::class, 'allCampaign'])->name('frontend.campaign');
Route::get('/all-category', [CampaignFrontController::class, 'allCategory']);



Route::controller(CampaignFrontController::class)->group(function () {
    Route::get('/detail-campaign/{slug}', 'detail');

    Route::post('/store-donation', 'store_donation')->name('store_donation');
});


//BACKEND
Route::middleware(['auth', 'CheckRoles:Admin'])->group(function () {

    Route::get('/dashboard', function () {
        $count_user = User::where('role_id', 2)->count();
        $donations = Donation::sum('amount');
        $campaign = Campaign::count();
        return view('backend.index', [
            'count_user' => $count_user,
            'donations' => $donations,
            'campaign' => $campaign,
        ]);
    });

    Route::controller(CampaignController::class)->group(function () {
        Route::get('/campaign', 'index');
        Route::get('/campaign/donations/{id}', 'donations');
        Route::get('/campaign/donations/print/{id}', 'print');
        Route::get('/campaign/create', 'create');
        Route::post('/campaign', 'store');
        Route::get('/campaign/{id}', 'edit');
        // Route::get('/campaign/show/{id}', 'show');
        Route::post('/campaign/update/{id}', 'update');
        Route::get('/campaign/delete/{id}', 'destroy');
        Route::get('/donations', 'donations');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{id}', 'edit');
        // Route::get('/category/show/{id}', 'show');
        Route::post('/category/update/{id}', 'update');
        Route::get('/category/delete/{id}', 'destroy');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{id}', 'edit');
        // Route::get('/users/show/{id}', 'show');
        Route::post('/users/update/{id}', 'update');
        Route::get('/users/delete/{id}', 'destroy');
    });
    Route::controller(MemberController::class)->group(function () {
        Route::get('/members', 'index')->name('member.index');
        Route::get('/members/{id}', 'show')->name('member.show');
 
    });
});
Route::middleware(['auth', 'CheckRoles:User,Admin'])->group(function () {
    Route::get('my-donation', [CampaignFrontController::class, 'myDonation']);
    Route::post('/detail-campaign/comment', [CampaignFrontController::class, 'comment'])->name('store_comment');
});

// Route::get('/', function () {
//     return view('welcome');
// });
