<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DateInfoController, TaskCompletionTimeController};

Route::get('/dates/date-info', DateInfoController::class);
Route::post('/tasks/completion-time', TaskCompletionTimeController::class);
