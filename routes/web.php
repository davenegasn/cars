<?php

use App\Http\Controllers\BrandSearchController;
use App\Http\Controllers\VehicleYearSearchController;
use App\Jobs\ProcessWordpressBrand;
use App\Jobs\ProcessWordpressEquipments;
use App\Jobs\ProcessWordpressVehicle;
use App\Livewire\Dashboard;
use App\Livewire\VehicleCreate;
use App\Livewire\VehicleEdit;
use App\Livewire\VehicleList;
use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/brands', BrandSearchController::class)->name('brands.api.index');
    Route::get('/years', VehicleYearSearchController::class)->name('years.api.index');
   

    Route::prefix('vehiculos')->group(function () {
        Route::get('/nuevo', VehicleCreate::class)->name('vehicle.create');
        Route::get('/editar/{id}', VehicleEdit::class)->name('vehicle.edit');
    });
   
});
