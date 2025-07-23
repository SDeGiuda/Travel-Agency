<?php

declare(strict_types=1);

use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Route;
use Lightit\Backoffice\Airlines\App\Controllers\CreateAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\DeleteAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\GetAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\ListAirlineController;
use Lightit\Backoffice\Airlines\App\Controllers\UpdateAirlineController;
use Lightit\Backoffice\Cities\App\Controllers\DeleteCityController;
use Lightit\Backoffice\Cities\App\Controllers\GetCityController;
use Lightit\Backoffice\Cities\App\Controllers\ListCityController;
use Lightit\Backoffice\Cities\App\Controllers\StoreCityController;
use Lightit\Backoffice\Cities\App\Controllers\UpdateCityController;
use Lightit\Backoffice\Flights\App\Controllers\DeleteFlightController;
use Lightit\Backoffice\Flights\App\Controllers\GetFlightController;
use Lightit\Backoffice\Flights\App\Controllers\ListFlightController;
use Lightit\Backoffice\Flights\App\Controllers\StoreFlightControlller;
use Lightit\Backoffice\Flights\App\Controllers\UpdateFlightController;
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
    Route::get('/', ListAirlineController::class);
    Route::post('/', CreateAirlineController::class);
    Route::prefix('/{airline}')->group(static function (): void {
        Route::get('/', GetAirlineController::class);
        Route::put('/', UpdateAirlineController::class);
        Route::delete('/', DeleteAirlineController::class);
    });
});

Route::prefix('cities')->name('cities.')->group(static function (): void {
    Route::get('/', ListCityController::class);
    Route::post('/', StoreCityController::class);
    Route::prefix('/{city}')->group(static function (): void {
        Route::put('/', UpdateCityController::class);
        Route::delete('/', DeleteCityController::class);
        Route::get('/', GetCityController::class);
    });
});


Route::prefix('flights')->group(static function (): void {
    Route::get('/', ListFlightController::class);
    Route::post('/', StoreFlightControlller::class);
    Route::prefix('/{flight}')->group(static function (): void {
        Route::put('/', UpdateFlightController::class);
        Route::delete('/', DeleteFlightController::class);
        Route::get('/', GetFlightController::class);
    });
});

