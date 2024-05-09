<?php

use App\Http\Controllers\AssignNewsController;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\EmployeeDetails;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DraftNewsController;
use App\Http\Controllers\SubEditorController;
use App\Http\Controllers\AssignRolePermissionController;
use App\Http\Controllers\CentreNewsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EmployeeDetailsController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\KPIController;
use App\Http\Controllers\ReadingCentralController;
use App\Http\Controllers\TrackingController;

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
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('logout01', function () {
    auth()->logout();
    return redirect('/');
});


Route::get('checkRole', function () {
    // $user = auth()->user();
    // $role= Role::where('slug','editor')->first();
    // $user->roles()->attach($role);

    //dd($user->hasRole('editor'));

    // $permissions = Permission::first();
    // $user->permissions()->attach($permissions);

    return 'Done';
});
Route::group(['middleware' => ['auth', 'role:editor']], function () {
    Route::get('canRole', function () {
        dd('hi');
    });
});









//role route
Route::controller(RoleController::class)
    ->group(function () {
        Route::get('role', 'index')->name('role');
        Route::get('role/show', 'show')->name('role.show');
        Route::get('role/create', 'create')->name('role.create');
        Route::post('role/store', 'store')->name('role.store');
        Route::get('role/edit/{role}', 'edit')->name('role.edit');
        Route::post('role/update/{role}', 'update')->name('role.update');
        Route::delete('role/delete/{role}', 'destroy')->name('role.delete');
    })
    ->middleware(['auth', 'verified']);










//permission Route

Route::controller(PermissionController::class)
    ->group(function () {
        Route::get('permission', 'index')->name('permission');
        Route::get('permission/show', 'show')->name('permission.show');
        Route::get('permission/create', 'create')->name('permission.create');
        Route::post('permission/store', 'store')->name('permission.store');
        Route::get('permission/edit/{permission}', 'edit')->name('permission.edit');
        Route::post('permission/update/{permission}', 'update')->name('permission.update');
        Route::delete('permission/delete/{permission}', 'destroy')->name('permission.delete');
    })
    ->middleware(['auth', 'verified']);

Route::controller(AssignRolePermissionController::class)
    ->group(function () {
        Route::get('rolePermission', 'index')->name('rolePermission');
        Route::get('rolePermission/show', 'show')->name('rolePermission.show');
        Route::get('rolePermission/create/{role}', 'create')->name('rolePermission.create');
        Route::post('rolePermission/store/{role}', 'store')->name('rolePermission.store');
        Route::get('rolePermission/edit/{permission}', 'edit')->name('rolePermission.edit');
        Route::post('rolePermission/update/{permission}', 'update')->name('rolePermission.update');
        Route::delete('rolePermission/delete/{permission}', 'destroy')->name('rolePermission.delete');
    })
    ->middleware(['auth', 'verified']);











//profile route

Route::controller(EmployeeProfileController::class)
    ->group(function () {
        Route::get('profilePhoto', 'profilePhoto')->name('profilePhoto');
        Route::post('profilePhotoUpdate', 'profilePhotoUpdate')->name('profilePhotoUpdate');
        Route::get('profile', 'profile')->name('profile');
        Route::get('get/profile/details', 'getProfileDetails')->name('getProfileDetails');
    })
    ->middleware(['auth', 'verified']);









Route::controller(EmployeeDetailsController::class)
    ->group(function () {
        Route::post('employee/details/{id}', 'employeeDetails')->name('employeeDetails');
    })
    ->middleware(['auth', 'verified']);







Route::controller(DepartmentController::class)
    ->group(function () {
        Route::get('department', 'index')->name('department');
        Route::get('department/show', 'show')->name('department.show');
        Route::get('department/create', 'create')->name('department.create');
        Route::post('department/store', 'store')->name('department.store');
        Route::get('department/edit/{department}', 'edit')->name('department.edit');
        Route::post('department/update/{department}', 'update')->name('department.update');
        Route::delete('department/delete/{department}', 'destroy')->name('department.delete');
    })
    ->middleware(['auth', 'verified']);










// Here Only Position Route

Route::controller(PositionController::class)
    ->group(function () {
        Route::get('position', 'index')->name('position');
        Route::get('position/show', 'show')->name('position.show');
        Route::get('position/create', 'create')->name('position.create');
        Route::post('position/store', 'store')->name('position.store');
        Route::get('position/edit/{position}', 'edit')->name('position.edit');
        Route::post('position/update/{position}', 'update')->name('position.update');
        Route::delete('position/delete/{position}', 'destroy')->name('position.delete');
    })
    ->middleware(['auth', 'verified']);












// Here Only Employee Route

Route::controller(EmployeeController::class)
    ->group(function () {
        Route::get('employee', 'index')->name('employee');
        Route::get('employee/show/{employee}', 'show')->name('employee.show');
        Route::get('employee/create', 'create')->name('employee.create');
        Route::post('employee/store', 'store')->name('employee.store');
        Route::get('employee/edit/{employee}', 'edit')->name('employee.edit');
        Route::post('employee/update/{employee}', 'update')->name('employee.update');
        Route::delete('employee/delete/{employee}', 'destroy')->name('employee.delete');
    })
    ->middleware(['auth', 'verified']);











//here only News route

Route::controller(NewsController::class)
    ->group(function () {
        Route::get('news', 'index')->name('news');
        Route::get('news/show/{news}', 'show')->name('news.show');
        Route::get('news/create', 'create')->name('news.create');
        Route::post('news/store', 'store')->name('news.store');
        Route::get('news/edit/{news}', 'edit')->name('news.edit');
        Route::post('news/update/{news}', 'update')->name('news.update');
        Route::delete('news/delete/{news}', 'destroy')->name('news.delete');
    })
    ->middleware(['auth', 'verified']);











//here only Draft News route

Route::controller(DraftNewsController::class)
    ->group(function () {
        Route::get('draft', 'index')->name('draft');
        Route::get('draft/show/{news}', 'show')->name('draft.show');
        Route::get('draft/create', 'create')->name('draft.create');
        Route::post('draft/store', 'store')->name('draft.store');

        Route::get('draft/edit/{draftNews}', 'edit')->name('draft.edit');
        Route::post('draft/update/{draftNews}', 'update')->name('draft.update');
        Route::delete('draft/delete/{draftNews}', 'destroy')->name('draft.delete');
    })
    ->middleware(['auth', 'verified']);











//here only Centre News route

Route::controller(CentreNewsController::class)
    ->group(function () {
        Route::get('centre', 'index')->name('centre');

        Route::get('allCentreNews', 'AllCentreNews')->name('centre.allNews');

        Route::get('centre/show/{centreNews}', 'show')->name('centre.show');
        Route::get('centre/create', 'create')->name('centre.create');
        Route::post('centre/store', 'store')->name('centre.store');
        Route::get('centre/view', 'view')->name('centre.view');
        Route::post('centre/store/draft/{id}', 'draft_store')->name('centre.store.draft');
        Route::get('centre/edit/{centreNews}', 'edit')->name('centre.edit');
        Route::post('centre/update/{centreNews}', 'update')->name('centre.update');
        Route::delete('centre/delete/{centreNews}', 'destroy')->name('centre.delete');

        Route::get('centre/print/{centreNews}', 'print')->name('centre.print');
    })
    ->middleware(['auth', 'verified']);












//here only Sub editors/ Reading Centre News route

Route::controller(ReadingCentralController::class)
    ->group(function () {
        Route::get('reading', 'index')->name('sub_editor');
        Route::get('getData', 'returnData');
        Route::get('getEmployeeFromReading', 'employeeFromReading');
        Route::get('reading/show/{subEditor}', 'show')->name('sub_editor.show');
        Route::get('reading/create', 'create')->name('sub_editor.create');
        Route::post('reading/store/{subEditor}', 'store')->name('sub_editor.store');
        Route::post('reading/store/draft/{subEditor}', 'draft_store')->name('sub_editor.store.draft');

        Route::post('sub_editor/store/check/{id}', 'check')->name('sub_editor.store.check');

        Route::get('reading/edit/{subEditor}', 'edit')->name('sub_editor.edit');
        Route::post('reading/update/{subEditor}', 'update')->name('sub_editor.update');
        Route::delete('sub_editor/delete/{subEditor}', 'destroy')->name('sub_editor.delete');

        // Here Update News[ When a redaing section update the news but not complete the news]
        Route::post('reading/update/central/reading/news/{subEditor}', 'updateCentralNewsbyReading')->name('reading.updateCentralNewsbyReading');
   
        // Here Update proof news by reading centre

        Route::post('reading/update/proof/news/{subEditor}', 'updateProofNews')->name('reading.updateProofNews');
   
    })
    ->middleware(['auth', 'verified']);












//here only Sub editors News route


Route::controller(TrackingController::class)
    ->group(function () {
        // tracking here
        Route::get('tracker/{subEditor}', 'tracking')->name('sub_editor.tracking');

        Route::post('cancel/track/{subEditor}', 'cancelTrack')->name('cancel.tracking');
    })
    ->middleware(['auth', 'verified']);















    //Reading Controller -> My News , Today Complete News etc
Route::controller(ReadingController::class)
    ->group(function () {
        Route::get('reading/mycomplete/news', 'completeNews')->name('reading.myNews');
        Route::get('reading/myRawNews/', 'rawNews')->name('reading.myRawNews');
        Route::get('reading/todayCompleteNews/', 'todayCompleteNews')->name('reading.todayCompleteNews');

        //view Complete News
        Route::get('reading/view/complete/news/{news}', 'view')->name('reading.view');

        // Edit Complete News
        Route::get('reading/edit/complete/news/{news}', 'edit')->name('reading.edit');
        Route::post('reading/update/complete/news/{reading}', 'update')->name('reading.update');
    })
    ->middleware(['auth', 'verified']);















//KPI Controller
Route::controller(KPIController::class)
    ->group(function () {
        Route::get('EmployeeKPI', 'EmployeeKPI')->name('kpi.EmployeeKPI');
        Route::get('EmployeeKPI/{date}', 'EmployeeKPIFilterByDate')->name('kpi.EmployeeKPIByDate');
        Route::get('EmployeeKPIFilter', 'EmployeeKPIFilterByFromToDate')->name('kpi.EmployeeKPIByFromToDate');
    })
    ->middleware(['auth', 'verified']);

// Assign News Controller

Route::controller(AssignNewsController::class)
    ->group(function () {
        Route::get('assignNews', 'index')->name('assignNews');
        Route::post('assignNews/{subEditor}', 'assignNewsToUser')->name('assignNews.assign');

        Route::get('assignNews/edit/{news}', 'edit')->name('assignNews.edit');
        Route::post('assignNews/update/{news}', 'update')->name('assignNews.update');

        Route::post('assignNews/iScomplete/{news}', 'isComplete')->name('assignNews.complete');
    })
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
