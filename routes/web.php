<?php

use App\Http\Controllers\CentreNewsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DraftNewsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PositionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubEditorController;

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
    return view('auth.login');
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

//here only Draft News route

Route::controller(DraftNewsController::class)->group(function () {
    Route::get('draft', 'index')->name('draft');
    Route::get('draft/show/{news}', 'show')->name('draft.show');
    Route::get('draft/create', 'create')->name('draft.create');
    Route::post('draft/store', 'store')->name('draft.store');

    Route::get('draft/edit/{draftNews}', 'edit')->name('draft.edit');
    Route::post('draft/update/{draftNews}', 'update')->name('draft.update');
    Route::delete('draft/delete/{draftNews}', 'destroy')->name('draft.delete');
})->middleware(['auth', 'verified']);




//here only Centre News route

Route::controller(CentreNewsController::class)->group(function () {
    Route::get('centre', 'index')->name('centre');
    Route::get('centre/show/{centreNews}', 'show')->name('centre.show');
    Route::get('centre/create', 'create')->name('centre.create');
    Route::post('centre/store', 'store')->name('centre.store');
    Route::get('centre/view', 'view')->name('centre.view');
    Route::post('centre/store/draft/{id}', 'draft_store')->name('centre.store.draft');
    Route::get('centre/edit/{centreNews}', 'edit')->name('centre.edit');
    Route::post('centre/update/{centreNews}', 'update')->name('centre.update');
    Route::delete('centre/delete/{centreNews}', 'destroy')->name('centre.delete');
})->middleware(['auth', 'verified']);


//here only Sub editors News route

Route::controller(SubEditorController::class)->group(function () {
    Route::get('sub_editor', 'index')->name('sub_editor');
    Route::get('centre/show/{subEditor}', 'show')->name('sub_editor.show');
    Route::get('centre/create', 'create')->name('sub_editor.create');
    Route::post('centre/store/{subEditor}', 'store')->name('sub_editor.store');
    Route::post('centre/store/draft/{subEditor}', 'draft_store')->name('sub_editor.store.draft');
    Route::get('centre/edit/{subEditor}', 'edit')->name('sub_editor.edit');
    Route::post('centre/update/{subEditor}', 'update')->name('sub_editor.update');
    Route::delete('centre/delete/{subEditor}', 'destroy')->name('sub_editor.delete');
})->middleware(['auth', 'verified']);




Route::get('/page2', function () {
    return view('backend.pages.department.index');
});












require __DIR__.'/auth.php';
