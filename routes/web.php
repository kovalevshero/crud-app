<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Employee;

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

Route::get('/token', function () {
    return csrf_token();
});

Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/employee', [EmployeeController::class, 'create']);
Route::post('/employee/update', [EmployeeController::class, 'update']);
Route::get('getEmployee', function (Request $request) {
    if ($request->ajax()) {
        $data = Employee::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
})->name('employee.index');
