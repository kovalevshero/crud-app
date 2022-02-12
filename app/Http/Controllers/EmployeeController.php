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

    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;

        $employees = Employee::find($id);
        $employees->name = $name;
        $employees->email = $email;
        $employees->save();

        return redirect('/employee')->with('success', 'Berhasil mengubah data!');
    }

    public function delete($id)
    {
        $employees = Employee::find($id);
        $employees->delete();

        return redirect('/employee')->with('success', 'Berhasil menghapus data!');
    }
}
