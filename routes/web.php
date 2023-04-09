<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('task')->group(function(){
    
    Route::post('/add_task',[TaskController::class,'add_task']);


    Route::post('/mark_complete/{id}',[TaskController::class,'mark_complete']);

    Route::post('/mark_un_complete/{id}',[TaskController::class,'mark_un_complete']);

    Route::get('/completed_tasks', function () {
        return view('completed_tasks');
    });


});
