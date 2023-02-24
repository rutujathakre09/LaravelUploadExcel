<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController; 

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
    return view('employees');
});

Route::get('excel-upload', [EmployeesController::class, 'excelUpload'])->name('excel-upload');
Route::post('excel-import', [EmployeesController::class, 'excelImport'])->name('excel-import');
Route::get('employees', [EmployeesController::class, 'index'])->name('emp.index');
Route::get('employees/{id}', [EmployeesController::class, 'viewEmployee'])->name('emp.view');
Route::post('editEmployee', [EmployeesController::class, 'editEmployee'])->name('emp.edit');
Route::delete('employees/delete', [EmployeesController::class, 'destroy'])->name('emp.destroy');

