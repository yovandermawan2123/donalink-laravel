<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CampaignAPIController;
use App\Http\Controllers\API\DonationApiController;
use App\Http\Controllers\API\NotificationApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('member/{id}', [AuthAPIController::class, 'profile']);
Route::post('member/login', [AuthAPIController::class, 'login']);
Route::post('member/register', [AuthAPIController::class, 'store']);
Route::post('member/update', [AuthAPIController::class, 'profileUpdate']);
Route::post('member/logout', [AuthAPIController::class, 'logout'])->middleware('auth:sanctum');

Route::get('campaign', [CampaignAPIController::class, 'index']);
Route::get('campaign/{slug}', [CampaignAPIController::class, 'show']);

Route::post('donation', [DonationApiController::class, 'store']);
Route::get('donations/{id}', [DonationApiController::class, 'myDonation']);
Route::any('midtrans-callback', [DonationApiController::class, 'callback']);

//Notification
Route::get('notifications/{id}', [NotificationApiController::class, 'notification']);
Route::get('notifications/delete/{id}', [NotificationApiController::class, 'destroy']);