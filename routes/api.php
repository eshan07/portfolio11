<?php

use App\Http\Controllers\Api\Settings\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('/social-links', [SettingController::class, 'storeSocialLinks']);
Route::get('/social-links', [SettingController::class, 'getSocialLinks']);
