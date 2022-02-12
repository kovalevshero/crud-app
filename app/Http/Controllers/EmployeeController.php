<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return view('index', ['employee' => $employees]);
    }

    public function create(Request $request)
    {
        $employees = new Employee();
        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->save();

        return redirect('/employee')->with('success', 'Berhasil menambahkan data!');
    }
}
