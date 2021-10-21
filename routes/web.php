<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::group(['middleware' => ['auth']], function () {
    Route::post('clearSession', [App\Http\Controllers\HomeController::class, 'clearSession']);


    Route::resources([
        'unit' => \App\Http\Controllers\UnitController::class,
        'files' => \App\Http\Controllers\FilesController::class,
        'notes' => \App\Http\Controllers\NotesController::class,
        'branch' => \App\Http\Controllers\BranchController::class,
        'client' => \App\Http\Controllers\ClientController::class,
        'product' => \App\Http\Controllers\ProductController::class,
        'package' => \App\Http\Controllers\PackageController::class,
        'service' => \App\Http\Controllers\ServiceController::class,
        'employee' => \App\Http\Controllers\EmployeeController::class,
        'appointment' => \App\Http\Controllers\AppointmentController::class,
        'package_item' => \App\Http\Controllers\PackageItemController::class,
        'loyalty_points' => \App\Http\Controllers\LoyaltyPointsController::class,
        'appointment_book' => \App\Http\Controllers\AppointmentBookController::class,
        'cash_drawer' => \App\Http\Controllers\CashDrawerController::class,
    ]);
    // ............. Appointment
    Route::get('getBranchAppointments',[App\Http\Controllers\AppointmentController::class,'getBranchAppointments'])->name('appointment.getBranchAppointments');
    Route::get('getAppointmentView',[App\Http\Controllers\AppointmentController::class,'getAppointmentView'])->name('appointment.getAppointmentView');
    Route::post('cancalAppointment',[App\Http\Controllers\AppointmentBookController::class,'cancalAppointment'])->name('appointment_book.cancalAppointment');



    Route::get('getAppointmentModal', [App\Http\Controllers\AjaxAppointmentBookController::class, 'getAppointmentModal'])->name('appointment_book.getAppointmentModal');
    Route::get('getAppointmentDetailModal', [App\Http\Controllers\AjaxAppointmentBookController::class, 'getAppointmentDetailModal'])->name('appointment_book.getAppointmentDetailModal');
    Route::get('getItemsDataView', [App\Http\Controllers\AjaxAppointmentBookController::class, 'getItemsDataView'])->name('appointment_book.getItemsDataView');
    Route::post('unit/filter', [App\Http\Controllers\UnitController::class, 'filter'])->name('unit.filter');
});
