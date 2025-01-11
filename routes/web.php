<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssistancesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonorsController;
use App\Http\Controllers\EmployeeAttachmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'validate_login'])->middleware('guest')->name('validate_login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
// End Auth

// Users
Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
Route::get('/users/import', function () {
    return view('import');
});
// End Users

// Roles
Route::resource('roles', RolesController::class)->middleware('auth')->except('show');
// End Roles

// Employees
Route::get('/employees/trash', [EmployeesController::class, 'trash'])->name('employees.trash')->middleware('auth');

Route::delete('/employees/{employee}/force-delete', [EmployeesController::class, 'force_delete'])->name('employees.force_delete')->middleware('auth');

Route::get('/employees/{employee}/restore', [EmployeesController::class, 'restore'])->name('employees.restore')->middleware('auth');

Route::get('employees/roles', [EmployeesController::class, 'roles'])->name('employees.roles.index')->middleware('auth');

Route::get('employees/{employee}/roles/edit', [EmployeesController::class, 'editRoles'])->name('employees.roles.edit')->middleware('auth');

Route::put('employees/{employee}/roles/update', [EmployeesController::class, 'updateRoles'])->name('employees.roles.update')->middleware('auth');

Route::resource('employees', EmployeesController::class)->middleware('auth')->except('show');
// End Employees

// Admins
// Route::resource('admins', AdminsController::class)->middleware('auth');
// End Admins

// Assistances
Route::get('assistances/{user}/details', [AssistancesController::class, 'show_user_assistances'])->name('assistances.user')->middleware('auth');

Route::get('/assistances/trash', [AssistancesController::class, 'trash'])->name('assistances.trash')->middleware('auth');

Route::delete('/assistances/{assistance}/force-delete', [AssistancesController::class, 'force_delete'])->name('assistances.force_delete')->middleware('auth');

Route::get('/assistances/{assistance}/restore', [AssistancesController::class, 'restore'])->name('assistances.restore')->middleware('auth');

Route::resource('assistances', AssistancesController::class)->middleware('auth');
// End Assistances

// Donors
Route::get('/donors/trash', [DonorsController::class, 'trash'])->name('donors.trash')->middleware('auth');

Route::get('/donors/{donor}/restore', [DonorsController::class, 'restore'])->name('donors.restore')->middleware('auth');

Route::delete('/donors/{donor}/force-delete', [DonorsController::class, 'force_delete'])->name('donors.force_delete')->middleware('auth');

Route::resource('donors', DonorsController::class)->middleware('auth')->except('show');
// End Donors

// Queries
Route::get('/queries/employees', [QueriesController::class, 'employees'])->name('queries.employees')->middleware('auth');

Route::get('/queries/donors', [QueriesController::class, 'donors'])->name('queries.donors')->middleware('auth');
// End  Queries

// Settings
Route::get('employees/{employee}/edit-profile', [SettingsController::class, 'edit_profile'])->name('employees.editProfile')->middleware('auth');

Route::put('employees/{employee}/edit-profile', [SettingsController::class, 'edit_profile_check'])->name('employees.editProfileCheck')->middleware('auth');

Route::get('employees/{employee}/reset-password', [SettingsController::class, 'reset_password'])->name('employees.reset_password')->middleware('auth');

Route::post('employees/{employee}/reset-password', [SettingsController::class, 'reset_password_check'])->name('employees.reset_password_check')->middleware('auth');

Route::get('employees/reset-password-to-employee', [SettingsController::class, 'reset_password_to_employee'])->name('employees.reset_password_to_employee')->middleware('auth');

Route::post('employees/reset-password-to-employee', [SettingsController::class, 'verify_reset_password_to_employee'])->name('employees.reset_password_to_employee_verify')->middleware('auth');
//End Settings

// Notifications
Route::patch('/notifications/{notification}/read', [NotificationsController::class, 'markAsRead'])->name('notifications.read');

Route::get('/notifications/mark-all-read', [NotificationsController::class, 'markAllAsRead'])->name('notifications.read.all');
// End Notifications

// Attachments
Route::get('/attachments/{id}/download', [EmployeeAttachmentsController::class, 'download'])->name('attachments.download')->middleware('auth');

Route::get('employees/{employee}/attachments', [EmployeeAttachmentsController::class, 'index'])->name('employee.attachments.index')->middleware('auth');

Route::get('employees/{employee}/attachments/create', [EmployeeAttachmentsController::class, 'create'])->name('employee.attachments.create')->middleware('auth');

Route::post('/users/{id}/attachments', [EmployeeAttachmentsController::class, 'store'])->name('employee.attachments.store')->middleware('auth');

Route::get('/attachments/{identity_number}/{file_name}', [EmployeeAttachmentsController::class, 'open_file'])->name('attachments.open')->middleware('auth');



Route::delete('/attachments/{id}', [EmployeeAttachmentsController::class, 'destroy'])->name('attachments.destroy')
    ->middleware('auth');
// End Attachments

// Layour
Route::get('/{page?}', [AdminController::class, 'redirect'])->middleware('auth')->name('dashboard');
// End Layout
