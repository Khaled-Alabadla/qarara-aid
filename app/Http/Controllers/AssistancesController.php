<?php

namespace App\Http\Controllers;

use App\Models\Assistance;
use App\Models\Distribution;
use App\Models\Donor;
use App\Models\User;
use App\Notifications\AssistanceAdded;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AssistancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('assistances.index');

        $assistances = Assistance::all();

        $donors = Donor::all();

        return view('assistances/index', compact('assistances', 'donors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('assistances.create');

        $donors = Donor::all();

        $employees = User::all();

        return view('assistances.create', compact('employees', 'donors'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        Gate::authorize('assistances.create');

        $request->validate([
            'type' => 'required',
            'quantity' => 'required|numeric|gt:0',
            'donor_id' => 'required|exists:donors,id',
            'date' => 'required|string',
        ], [
            'type.required' => 'نوع المساعدة مطلوب',
            'quantity.required' => 'الكمية مطلوبة',
            'quantity.numeric' => 'الكمية يجب أن تكون رقم',
            'quantity.gt' => 'الكمية يجب أن تكون أكبر من صفر',
            'donor_id.required' => 'الجهة المانحة مطلوبة',
            'donor_id.exists' => 'الجهة المانحة غير موجودة',
        ]);

        // Get the date input from the request
        $dateInput = trim($request->date);

        // Try to parse the date with multiple formats
        try {
            $parsedDate = Carbon::createFromFormat('d/m/Y', $dateInput);
        } catch (\Exception $e) {

            return back()->withErrors(['date' => 'خطأ في تنسيق التاريخ، الرجاء الضغط على حقل الإدخال ثم الاختيار من التقويم'])->withInput();
        }

        $formattedDate = $parsedDate->format('Y-m-d');

        $assistance = Assistance::create([
            'type' => $request->type,
            'quantity' => $request->quantity,
            'donor_id' => $request->donor_id,
            'date' => $formattedDate, // Store the reformatted date
            'notes' => $request->notes,
        ]);

        foreach ($request->employees as $employeeId => $employeeData) {
            if (isset($employeeData['selected'])) {
                Distribution::create([
                    'assistance_id' => $assistance->id,
                    'donor_id' => $request->donor_id,
                    'user_id' => $employeeId,
                    'quantity' => $employeeData['quantity'],
                ]);

                // Send notification to the employee
                $employee = User::find($employeeId);
                $employee->notify(new AssistanceAdded($assistance));
            }
        }

        return redirect()->route('assistances.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function show(string $id)
    {
        Gate::authorize('assistances.show');

        $assistance = Assistance::with('distributes')->findOrFail($id);

        return view('assistances.show', compact('assistance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('assistances.update');

        $donors = Donor::all();

        $employees = User::all();

        $assistance = Assistance::with('distributes')->findOrFail($id);

        return view('assistances.edit', compact('donors', 'assistance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('assistances.update');

        $request->validate([
            'type' => 'required',
            'quantity' => 'required|numeric|gt:0',
            'donor_id' => 'required|exists:donors,id',
            'date' => 'required|string', // We will handle date format validation later
        ], [
            'type.required' => 'نوع المساعدة مطلوب',
            'quantity.required' => 'الكمية مطلوبة',
            'quantity.numeric' => 'الكمية يجب أن تكون رقم',
            'quantity.gt' => 'الكمية يجب أن تكون أكبر من صفر',
            'donor_id.required' => 'الجهة المانحة مطلوبة',
            'donor_id.exists' => 'الجهة المانحة غير موجودة',
        ]);

        $dateInput = trim($request->date);

        // Try to parse the date with multiple formats
        try {
            // First, try d-M-Y (like 23-Dec-2004)
            $parsedDate = Carbon::createFromFormat('d-M-Y', $dateInput);
        } catch (\Exception $e) {
            try {
                // If the first format fails, try d-m-Y (like 23-12-2004)
                $parsedDate = Carbon::createFromFormat('d-m-Y', $dateInput);
            } catch (\Exception $e) {
                try {
                    // If the previous formats fail, try d/m/Y (like 23/12/2004)
                    $parsedDate = Carbon::createFromFormat('d/m/Y', $dateInput);
                } catch (\Exception $e) {
                    try {
                        // If the previous formats fail, try Y-m-d (like 2004-12-23)
                        $parsedDate = Carbon::createFromFormat('Y-m-d', $dateInput);
                    } catch (\Exception $e) {
                        try {
                            // If the previous formats fail, try Y/m/d (like 2024/12/23)
                            $parsedDate = Carbon::createFromFormat('Y/m/d', $dateInput);
                        } catch (\Exception $e) {
                            // If none of the formats work, return an error
                            return back()->withErrors(['date' => 'خطأ في تنسيق التاريخ، الرجاء الضغط على حقل الإدخال ثم الاختيار من التقويم']);
                        }
                    }
                }
            }
        }

        $formattedDate = $parsedDate->format('Y-m-d');

        $assistance = Assistance::findOrFail($id);

        $assistance->update([
            'type' => $request->type,
            'quantity' => $request->quantity,
            'donor_id' => $request->donor_id,
            'date' => $formattedDate,
            'notes' => $request->notes,
        ]);

        foreach ($request->employees as $employeeId => $employeeData) {
            if (isset($employeeData['selected'])) {
                $distribution = Distribution::where('assistance_id', $id)
                    ->where('user_id', $employeeId)
                    ->first();

                if ($distribution) {
                    $distribution->update([
                        'quantity' => $employeeData['quantity'],
                        'donor_id' => $request->donor_id,
                    ]);
                } else {
                    Distribution::create([
                        'assistance_id' => $id,
                        'user_id' => $employeeId,
                        'donor_id' => $request->donor_id,
                        'quantity' => $employeeData['quantity'],
                    ]);

                    $employee = User::find($employeeId);
                    $employee->notify(new AssistanceAdded($assistance));
                }
            } else {
                Distribution::where('assistance_id', $id)
                    ->where('user_id', $employeeId)
                    ->delete();
            }
        }

        return redirect()->route('assistances.index')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('assistances.delete');

        Assistance::destroy($id);

        return redirect()->route('assistances.index')->with('success', 'تم الحذف بنجاح');
    }

    public function special($id)
    {
        Gate::authorize('assistances.user');

        $assistances = Assistance::where('id', $id)->get();

        return view('assistances.special', compact('assistances'));
    }

    public function trash()
    {
        Gate::authorize('assistances.trash');

        $assistances = Assistance::onlyTrashed()->get();

        return view('assistances.trash', compact('assistances'));
    }

    public function restore($id)
    {
        Gate::authorize('assistances.restore');

        Assistance::onlyTrashed()->find($id)->restore();

        return redirect()->route('assistances.index')->with('success', 'تمت الاستعادة بنجاح');

    }

    public function force_delete($id)
    {
        Gate::authorize('assistances.force_delete');

        Assistance::onlyTrashed()->find($id)->forceDelete();

        $ds = Distribution::where('assistance_id', $id)->get();

        return redirect()->route('assistances.index')->with('success', 'تم الحذف بنجاح');

    }

    public function show_user_assistances($id)
    {

        $user = User::findorFail($id);

        $distributes = Distribution::with('assistance')->where('user_id', $id)->get();

        return view('assistances.user', compact('distributes', 'user'));
    }
}
