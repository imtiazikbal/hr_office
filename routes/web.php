<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PositionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;

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
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
});


Route::get('/welcome', function () {
    return User::all();
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/addEmployee', function () {
    return view('addEmployee');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Here Only Department Route


Route::controller(DepartmentController::class)->group(function () {
    Route::get('department', 'index')->name('department');
    Route::get('department/show', 'show')->name('department.show');
    Route::get('department/create', 'create')->name('department.create');
    Route::post('department/store', 'store')->name('department.store');
    Route::get('department/edit/{department}', 'edit')->name('department.edit');
    Route::post('department/update/{department}', 'update')->name('department.update');
    Route::delete('department/delete/{department}', 'destroy')->name('department.delete');
})->middleware(['auth', 'verified']);



// Here Only Position Route

Route::controller(PositionController::class)->group(function () {
    Route::get('position', 'index')->name('position');
    Route::get('position/show', 'show')->name('position.show');
    Route::get('position/create', 'create')->name('position.create');
    Route::post('position/store', 'store')->name('position.store');
    Route::get('position/edit/{position}', 'edit')->name('position.edit');
    Route::post('position/update/{position}', 'update')->name('position.update');
    Route::delete('position/delete/{position}', 'destroy')->name('position.delete');
})->middleware(['auth', 'verified']);


// Here Only Employee Route

Route::controller(EmployeeController::class)->group(function () {
    Route::get('employee', 'index')->name('employee');
    Route::get('employee/show/{employee}', 'show')->name('employee.show');
    Route::get('employee/create', 'create')->name('employee.create');
    Route::post('employee/store', 'store')->name('employee.store');
    Route::get('employee/edit/{employee}', 'edit')->name('employee.edit');
    Route::post('employee/update/{employee}', 'update')->name('employee.update');
    Route::delete('employee/delete/{employee}', 'destroy')->name('employee.delete');
})->middleware(['auth', 'verified']);


//here only News route

Route::controller(NewsController::class)->group(function () {
    Route::get('news', 'index')->name('news');
    Route::get('news/show', 'show')->name('news.show');
    Route::get('news/create', 'create')->name('news.create');
    Route::post('news/store', 'store')->name('news.store');
    Route::get('news/edit/{news}', 'edit')->name('news.edit');
    Route::post('news/update/{news}', 'update')->name('news.update');
    Route::delete('news/delete/{news}', 'destroy')->name('news.delete');
})->middleware(['auth', 'verified']);



Route::get('/page2', function () {
    return view('backend.pages.department.index');
});












require __DIR__.'/auth.php';
