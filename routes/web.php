<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->name('api.')->group(
    base_path('routes/api.php')
);
