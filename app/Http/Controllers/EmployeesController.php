<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('employees.index');

        $employees = User::all();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('employees.create');

        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('employees.create');

        $request->validate([
            'name' => 'required|min:10|max:70',
            'identity_number' => 'required|size:9|unique:users,identity_number',
            'email' => 'nullable|email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'position' => 'required|in:مثبت,عقد,عضو مجلس',
            'family_size' => 'required',
            'wife_name' => 'nullable|min:10|max:70',
            'status' => 'required|in:متزوج,أعزب',
            'wife_identity_number' => 'nullable|size:9|unique:users,wife_identity_number',



        ], [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'يجب أن يحتوي الاسم على الأقل 10 أحرف',
            'name.max' => 'يجب ألا يزيد الاسم عن 70 حرف',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 أحرف',
            'position.required' => ' المركز الوظيفي مطلوب',
            'position.in' => 'يجب أن يكون المركز الوظيفي أحد الخيارات التالية: عضو كجلس، مثبت، عقد',
            'identity_number.required' => 'رقم الهوية مطلوب',
            'identity_number.size' => 'يجب أن يتكون رقم الهوية من 9 أرقام فقط',
            'identity_number.unique' => 'رقم الهوية مسجل مسبقا',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'phone.required' => 'رقم الجوال مطلوب',
            'family_size.required' => 'عدد أفراد الأسرة مطلوب',
            'wife_name.min' => 'يجب أن يحتوي اسم الزوجة على الأقل 10 أحرف',
            'wife_name.max' => 'يجب ألا يزيد اسم الزوجة عن 70 حرف',
            'status.required' => 'الحالة الاجتماعية مطلوبة',
            'status.in' => 'يجب أن تكون الحالة الاجتماعية إحدى الخيارات التالية: متزوج،أعزب',
            'wife_identity_number.size' => 'يجب أن يتكون رقم هوية الزوجة من 9 أرقام فقط',
            'wife_identity_number.unique' => 'رقم هوية الزوجة مسجل مسبقا',

        ]);


        $user = User::create([
            'name' => $request->name,
            'identity_number' => $request->identity_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'position' => $request->position,
            'family_size' => $request->family_size,
            'status' => $request->status,
            'wife_name' => $request->wife_name,
            'wife_identity_number' => $request->wife_identity_number
        ]);

        $role = Role::where('name', 'موظف')->first();

        $user->roles()->attach($role);

        return redirect()->route('employees.index')->with('success', 'تم إضافة الموظف بنجاح');
    }

    //913587145

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('employees.update');

        $employee = User::findOrFail($id);

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('employees.update');

        $request->validate([
            'name' => 'required|min:10|max:70',
            'identity_number' => "required|size:9|unique:users,identity_number,$id",
            'email' => 'nullable|email',
            'phone' => 'required',
            'position' => 'required|in:مثبت,عقد,عضو مجلس',
            'family_size' => 'required',
            'wife_name' => 'nullable|min:10|max:70',
            'status' => 'required|in:متزوج,أعزب',
            'wife_identity_number' => "nullable|size:9|unique:users,wife_identity_number,$id",

        ], [
            'name.required' => 'الاسم مطلوب',
            'name.min' => 'يجب أن يحتوي الاسم على الأقل 10 أحرف',
            'name.max' => 'يجب ألا يزيد الاسم عن 70 حرف',
            'position.required' => ' المركز الوظيفي مطلوب',
            'position.in' => 'يجب أن يكون المركز الوظيفي أحد الخيارات التالية: عضو كجلس، مثبت، عقد',
            'identity_number.required' => 'رقم الهوية مطلوب',
            'identity_number.size' => 'يجب أن يتكون رقم الهوية من 9 أرقام فقط',
            'identity_number.unique' => 'رقم الهوية مسجل مسبقا',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'phone.required' => 'رقم الجوال مطلوب',
            'family_size.required' => 'عدد أفراد الأسرة مطلوب',
            'wife_name.min' => 'يجب أن يحتوي اسم الزوجة على الأقل 10 أحرف',
            'wife_name.max' => 'يجب ألا يزيد اسم الزوجة عن 70 حرف',
            'status.required' => 'الحالة الاجتماعية مطلوبة',
            'status.in' => 'يجب أن تكون الحالة الاجتماعية إحدى الخيارات التالية: متزوج،أعزب',
            'wife_identity_number.size' => 'يجب أن يتكون رقم هوية الزوجة من 9 أرقام فقط',
            'wife_identity_number.unique' => 'رقم هوية الزوجة مسجل مسبقا',
        ]);

         User::findOrFail($id)->update([
            'name' => $request->name,
            'identity_number' => $request->identity_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'family_size' => $request->family_size,
            'status' => $request->status,
            'wife_name' => $request->wife_name,
            'wife_identity_number' => $request->wife_identity_number
        ]);

        return redirect()->route('employees.index')->with('success', 'تم تعديل بيانات الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('employees.delete');

        User::destroy($id);

        return redirect()->back()->with('success', 'تم حذف الموظف بنجاح');
    }

    public function trash()
    {
        Gate::authorize('employees.trash');

        $employees = User::onlyTrashed()->get();

        return view('employees.trash', compact('employees'));
    }

    public function restore($id)
    {
        Gate::authorize('employees.restore');

        $employee = User::onlyTrashed()->find($id)->restore();

        return redirect()->route('employees.index')->with('success', 'تمت الاستعادة بنجاح');
    }
    public function force_delete($id)
    {
        Gate::authorize('employees.force_delete');

        $employee = User::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('employees.index')->with('success', 'تمت عملية الحذف بنجاح');
    }

    public function roles()
    {
        Gate::authorize('roles.users.index');

        $employees = User::with('roles')->get();

        return view('employees.roles.index', compact('employees'));
    }

    public function editRoles($id)
    {
        Gate::authorize('roles.users.update');

        $employee = User::with('roles')->findOrFail($id);

        $roles = Role::all();

        return view('employees.roles.edit', compact('employee', 'roles'));
    }

    public function updateRoles(Request $request, $id)
    {
        Gate::authorize('roles.users.update');

        $request->validate([
            'roles' => 'required',
        ], [
            'roles.required' => 'قم بإضافة صلاحيات',
        ]);

        $employee = User::findOrFail($id);

        $employee->roles()->sync($request->roles);

        return redirect()->route('employees.roles.index')->with('success', 'تم تعديل الصلاحية بنجاح');
    }
  

}
