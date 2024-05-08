<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VendorPoolController;
use App\Http\Controllers\InLoadController;
use App\Http\Controllers\OutLoadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth
Route::get('/', [AuthController::class,'login']);
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/authenticate', [AuthController::class,'auth'])->name('authenticate');
Route::get('/forget-password', [AuthController::class, 'forget'])->name('forget-password');
Route::post('/forget-password', [AuthController::class, 'reset'])->name('reset-password');
Route::get('/reset-password/{token}', [AuthController::class, 'change'])->name('change-password');
Route::post('/reset-password', [AuthController::class, 'update'])->name('update-password');

Route::middleware(['auth'])->group(function() {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'profileupdate'])->name('profile.update');
    Route::post('/profile/updatepassword', [UserController::class, 'updatepassword'])->name('profile.updatepassword');

    //Role
    Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('can:role_view');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store')->middleware('can:role_add');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('can:role_edit');
    Route::post('/role/update', [RoleController::class, 'update'])->name('role.update')->middleware('can:role_edit');
    Route::get('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('can:role_delete');
    Route::get('/role/permission/{id}', [RoleController::class, 'haspermission'])->name('role.permissions')->middleware('can:role_has_permission');
    Route::post('/role/haspermissionupdate/{id}', [RoleController::class, 'haspermissionupdate'])->name('role.haspermissionupdate')->middleware('can:role_has_permission');

    //Permission
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions')->middleware('can:permission_view');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store')->middleware('can:permission_add');
    Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('can:permission_edit');
    Route::post('/permission/update', [PermissionController::class, 'update'])->name('permission.update')->middleware('can:permission_edit');
    Route::get('/permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy')->middleware('can:permission_delete');

    //User
    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('can:user_view');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('can:user_add');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('can:user_add');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('can:user_edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update')->middleware('can:user_edit');
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('can:user_delete');
    Route::get('/user/permission/{id}', [UserController::class, 'haspermission'])->name('user.permissions')->middleware('can:user_has_permission');
    Route::post('/user/haspermissionupdate', [UserController::class, 'haspermissionupdate'])->name('user.haspermissionupdate')->middleware('can:user_has_permission');

    //Driver
    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers')->middleware('can:driver_view');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create')->middleware('can:driver_add');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('driver.store')->middleware('can:driver_add');
    Route::get('/driver/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit')->middleware('can:driver_edit');
    Route::post('/driver/update/{id}', [DriverController::class, 'update'])->name('driver.update')->middleware('can:driver_edit');
    Route::get('/driver/destroy/{id}', [DriverController::class, 'destroy'])->name('driver.destroy')->middleware('can:driver_delete');

    //Distributor
    Route::get('/distributors', [DistributorController::class, 'index'])->name('distributors')->middleware('can:distributor_view');
    Route::get('/distributor/create', [DistributorController::class, 'create'])->name('distributor.create')->middleware('can:distributor_add');
    Route::post('/distributor/store', [DistributorController::class, 'store'])->name('distributor.store')->middleware('can:distributor_add');
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('distributor.edit')->middleware('can:distributor_edit');
    Route::post('/distributor/update/{id}', [DistributorController::class, 'update'])->name('distributor.update')->middleware('can:distributor_edit');
    Route::get('/distributor/destroy/{id}', [DistributorController::class, 'destroy'])->name('distributor.destroy')->middleware('can:distributor_delete');

    //Article
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles')->middleware('can:article_add');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('can:article_add');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store')->middleware('can:article_add');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit')->middleware('can:article_edit');
    Route::post('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update')->middleware('can:article_edit');
    Route::get('/article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy')->middleware('can:article_delete');

    //Shift
    Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts')->middleware('can:shift_view');;
    Route::get('/shift/create', [ShiftController::class, 'create'])->name('shift.create')->middleware('can:shift_add');
    Route::post('/shift/store', [ShiftController::class, 'store'])->name('shift.store')->middleware('can:shift_add');
    Route::get('/shift/edit/{id}', [ShiftController::class, 'edit'])->name('shift.edit')->middleware('can:shift_edit');
    Route::post('/shift/update/{id}', [ShiftController::class, 'update'])->name('shift.update')->middleware('can:shift_edit');
    Route::get('/shift/destroy/{id}', [ShiftController::class, 'destroy'])->name('shift.destroy')->middleware('can:shift_delete');

    //Vehicle
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles')->middleware('can:vehicle_view');
    Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create')->middleware('can:vehicle_add');
    Route::post('/vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store')->middleware('can:vehicle_add');
    Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicle.edit')->middleware('can:vehicle_edit');
    Route::post('/vehicle/update/{id}', [VehicleController::class, 'update'])->name('vehicle.update')->middleware('can:vehicle_edit');
    Route::get('/vehicle/destroy/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy')->middleware('can:vehicle_delete');

    //vendor pool
    Route::get('/vendorpools', [VendorPoolController::class, 'index'])->name('vendorpools')->middleware('can:vendor_pool_view');
    Route::get('/vendorpool/create', [VendorPoolController::class, 'create'])->name('vendorpool.create')->middleware('can:vendor_pool_add');
    Route::post('/vendorpool/store', [VendorPoolController::class, 'store'])->name('vendorpool.store')->middleware('can:vendor_pool_add');
    Route::get('/vendorpool/edit/{id}', [VendorPoolController::class, 'edit'])->name('vendorpool.edit')->middleware('can:vendor_pool_edit');
    Route::post('/vendorpool/update/{id}', [VendorPoolController::class, 'update'])->name('vendorpool.update')->middleware('can:vendor_pool_edit');
    Route::get('/vendorpool/destroy/{id}', [VendorPoolController::class, 'destroy'])->name('vendorpool.destroy')->middleware('can:vendor_pool_delete');

    //In Loads
    Route::get('/inloads', [InLoadController::class, 'index'])->name('inloads')->middleware('can:inload_view');
    Route::get('/inload/create', [InLoadController::class, 'create'])->name('inload.create')->middleware('can:inload_add');
    Route::get('/inload/getvehicles/{id}', [InLoadController::class, 'getVehicles'])->name('inload.getvehicles');
    Route::post('/inload/store', [InLoadController::class, 'store'])->name('inload.store')->middleware('can:inload_add');
    Route::get('/inload/edit/{id}', [InLoadController::class, 'edit'])->name('inload.edit')->middleware('can:inload_edit');
    Route::post('/inload/update/{id}', [InLoadController::class, 'update'])->name('inload.update')->middleware('can:inload_edit');
    Route::get('/inload/destroy/{id}', [InLoadController::class, 'destroy'])->name('inload.destroy')->middleware('can:inload_delete');

    //Out Loads
    Route::get('/outloads', [OutLoadController::class, 'index'])->name('outloads')->middleware('can:outload_view');
    Route::get('/outload/create', [OutLoadController::class, 'create'])->name('outload.create')->middleware('can:outload_add');
    Route::get('/outload/getvehicles/{id}', [InLoadController::class, 'getVehicles'])->name('outload.getvehicles');
    Route::post('/outload/store', [OutLoadController::class, 'store'])->name('outload.store')->middleware('can:outload_add');
    Route::get('/outload/edit/{id}', [OutLoadController::class, 'edit'])->name('outload.edit')->middleware('can:outload_edit');
    Route::post('/outload/update/{id}', [OutLoadController::class, 'update'])->name('outload.update')->middleware('can:vendor_pool_edit');
    Route::get('/outload/destroy/{id}', [OutLoadController::class, 'destroy'])->name('outload.destroy')->middleware('can:vendor_pool_delete');
});
