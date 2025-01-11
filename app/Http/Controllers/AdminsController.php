<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
 
    public function index()
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();

        return view('admins.index', compact('admins'));
    }


    public function create()
    {
        $employees = User::where('role', 'employee')->get();

        return view('admins.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'role' => 'required|in:admin,super_admin',
        ], [
            'id.required' => ' الاسم مطلوب',
            'id.exists' => 'هذا الموظف غير موجود',
            'role.required' => 'الصلاحية مطلوبة',
            'role.in' => 'يجب أن تتضمن الصلاحية إحدى القيم التالية: مسؤول، مشرف أعلى',
        ]);

        User::where('id', $request->id)->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admins.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function show(string $id)
    {
        return view('home');
    }


    public function edit(string $id)
    {
        $employees = User::all();

        $admin = User::findOrFail($id);

        return view('admins.edit', compact('admin', 'employees'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'id' => 'required|exists:users,id',
            'role' => 'required|in:admin,super_admin',
        ], [
            // 'id.required' => ' الاسم مطلوب',
            // 'id.exists' => 'هذا الموظف غير موجود',
            'role.required' => 'الصلاحية مطلوبة',
            'role.in' => 'يجب أن تتضمن الصلاحية إحدى القيم التالية: مسؤول، مشرف أعلى',
        ]);

        User::where('id', $id)->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admins.index')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(string $id)
    {
        $admin = User::adminsAndSuperAdmins()->find($id);

        $admin->update([
            "role" => "employee",
            'family_size' => 20
        ]);

        return redirect()->route('admins.index')->with('success', 'تم الحذف بنجاح');
    }

}
