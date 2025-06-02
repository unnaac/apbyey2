<?php

use App\Http\Controllers\FirebaseAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/firebase/verify-token', [FirebaseAuthController::class, 'verifyToken']);
