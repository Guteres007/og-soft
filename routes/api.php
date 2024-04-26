<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateInfoController;

Route::get('/dates/date-info', DateInfoController::class);
