<?php

declare(strict_types=1);

use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Route;
use Lightit\Backoffice\Airlines\App\Controllers\CreateAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\DeleteAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\GetAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\ListAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\UpdateAirlineController;
use Lightit\Backoffice\Users\App\Controllers\DeleteUserController;
use Lightit\Backoffice\Users\App\Controllers\GetUserController;
use Lightit\Backoffice\Users\App\Controllers\ListUserController;
use Lightit\Backoffice\Users\App\Controllers\StoreUserController;
use Lightit\Backoffice\Users\App\Controllers\UpdateUserController;

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

Route::middleware('auth:sanctum')
    ->get('/me', function (#[CurrentUser] $user) {
        return response()->json([
            'data' => $user,
        ]);
    });

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/
Route::prefix('users')
    ->middleware([])
    ->group(static function (): void {
        Route::get('/', ListUserController::class);
        Route::get('/{user}', GetUserController::class)
            ->withTrashed()
            ->whereNumber('user');
        Route::post('/', StoreUserController::class);
        Route::put('/{user}', UpdateUserController::class)
            ->whereNumber('user');
        Route::delete('/{user}', DeleteUserController::class)
            ->whereNumber('user');
    });

Route::prefix('airlines')->name('airlines.')->group(static function (): void {
    Route::get('/', ListAirlineController::class)->name('index');
    Route::get('/{airline}', GetAirlineController::class)->name('show');
    Route::post('/', CreateAirlineController::class)->name('store');
    Route::put('/{airline}', UpdateAirlineController::class)->name('update');
    Route::delete('/{airline}', DeleteAirlineController::class)->name('destroy');
});

