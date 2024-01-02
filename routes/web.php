<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\YourControllerName;
use App\Http\Controllers\SiteController;


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

Route::get('/', [SiteController::class, 'home']);

Route::get('/register', [SiteController::class, 'register']);
Route::post('/postregister', [SiteController::class, 'postregister']);




Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/postlogin', [loginController::class, 'postlogin']);
Route::get('/logout', [loginController::class, 'logout']);


Route::group(['middleware' => ['auth','checkRole:admin']], function(){

    
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa/create',[SiswaController::class, 'create']);
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit']);
    Route::post('/siswa/{siswa}/update', [SiswaController::class, 'update']);
    Route::get('/siswa/{siswa}/delete', [SiswaController::class, 'delete']);

    Route::get('/siswa/{siswa}/profile', [SiswaController::class, 'profile']);
    Route::post('/siswa/{siswa}/addnilai', [SiswaController::class, 'addnilai']);
    Route::get('/siswa/{siswa}/{idmapel}/deletetnilai', [SiswaController::class, 'deletenilai']); 
    Route::get('/guru/{id}/profile',[GuruController::class, 'profile']);
    Route::get('/siswa/export',[SiswaController::class, 'export']);
    Route::get('/siswa/exportpdf',[SiswaController::class, 'exportpdf']);
    


});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function(){

    Route::get('/dashboard', [DashboardController::class, 'index']);


});

Route::get('getdatasiswa', [
    'uses' => [SiswaController::class, 'getdatasiswa'],
    'as' => 'ajax.get.data.siswa'
]);
