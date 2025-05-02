<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Token;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('generateToken', [Token::class, 'generateToken'])->name('generateToken');

Route::post('generateRtcToken', [Token::class, 'generateRtcToken'])->name('generateRtcToken');

Route::post('start-recording', [Token::class, 'start_recording'])->name('start_recording');

Route::post('check-recording', [Token::class, 'check_recording'])->name('check_recording');

Route::post('stop-recording', [Token::class, 'stop_recording'])->name('stop_recording');
