<?php

use App\Http\Controllers\Admin\SchoolsController;
use App\Http\Controllers\Admin\StudentsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/unauthorized', function () {
    return 'unauthorized; please login first';
});
Route::resources([
    'admin/students' => StudentsController::class,
    'admin/schools' => SchoolsController::class
]);
