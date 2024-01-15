<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

Route::post('/login', [Auth\LoginController::class, 'login']);
Route::post('/register', [Auth\LoginController::class, 'register']);

Route::middleware('auth:api')->group(function() {

    Route::controller(Auth\LoginController::class)->prefix('user')->group(function() {
        Route::post('logout','logout');
    });

    Route::controller(Sms\SmsController::class)->prefix('sms')->group(function() {
        Route::post('send','sendSms');
        Route::get('report','getSms');//Aynı zamanda tarih parametre olarak yollandığında filtrelenmiş sonuçlar listelenir.
        Route::get('{id}/detail','getSmsDetail');
    });

});

