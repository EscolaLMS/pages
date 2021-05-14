<?php

use EscolaLms\Pages\Http\Controllers\PagesApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/pages'], function () {
    Route::get('/', [PagesApiController::class, 'list']);
    Route::get('{slug}', [PagesApiController::class, 'read']);
    Route::post('{slug}', [PagesApiController::class, 'create']);
    Route::delete('{slug}', [PagesApiController::class, 'delete']);
    Route::patch('{slug}', [PagesApiController::class, 'update']);
});
