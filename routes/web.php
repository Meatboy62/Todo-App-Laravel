<?php

use App\Http\Controllers\GetProjectsController;
use App\Http\Controllers\PersonalInfoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ejemplo', function () {
    return view('welcome');
});

Route::prefix('profile/')
    ->name('profile.')
    ->group(function () {

        Route::controller(PersonalInfoController::class)
            ->group(function () {

                Route::get('get-user', 'getUser')
                    ->name('get_user');
            });

            Route::get('get-projects', GetProjectsController::class)
                ->name("get_projetcs");
    });
