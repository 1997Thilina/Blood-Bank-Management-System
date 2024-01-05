<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankStaffController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\BloodTypeController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\EmailSettingsController;
use App\Http\Controllers\HospitalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\ReportInvoiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingHoursController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'viewDashboard'])->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



require __DIR__ . '/auth.php';

////////////////////////// blood bank staff /////////////////////////////////
Route::middleware(['auth', 'role:admin,Blood_Bank_Staff'])->group(function () {

    Route::get('/makeReservation', [BloodRequestController::class, 'viewMakeReservation'])->name('viewMakeReservation');

    //Route::post('/changeBloodRequestStatus', [BloodRequestController::class, 'changeBloodRequestStatus'])->name('changeBloodRequestStatus');

    Route::get('/generateBloodReport', [ReportInvoiceController::class, 'generateBloodReport'])->name('generateBloodReport');

    // Route::get('/hospitals', [HospitalController::class, 'viewHospitals'])->name('viewHospitals');
    // Route::post('/addHospitals', [HospitalController::class, 'storeHospitals'])->name('storeHospitals');

    Route::get('/manageAppointments', [AdminController::class, 'ViewControlAppointment'])->name('ViewControlAppointment');

    Route::get('/addBloodStock', [BankStaffController::class, 'viewAddBloodStock'])->name('viewAddBloodStock');
    Route::post('/storeBloodStock', [BankStaffController::class, 'storeBloodStock'])->name('storeBloodStock');

    Route::get('/viewBloodStockDetails', [BankStaffController::class, 'viewBloodStockDetails'])->name('viewBloodStockDetails');

    // Route::get('/addBloodTypes', [BloodTypeController::class, 'viewAddBloodTypes'])->name('viewAddBloodTypes');
    // Route::post('/storeBloodTypes', [BloodTypeController::class, 'storeBloodTypes'])->name('storeBloodTypes');

    
    Route::get('/ManageEmails', [EmailSettingsController::class, 'viewManageEmails'])->name('viewManageEmails');
    Route::post('/sendMails', [EmailSettingsController::class, 'sendMails'])->name('sendMails');

});

//////////////////////////////admin ///////////////////////////////////////////
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/userManagement', [AdminController::class, 'viewUserManagement'])->name('viewUserManagement');

    Route::get('/addStaff', [AdminController::class, 'viewAddStaff'])->name('viewAddStaff');
    Route::post('/storeStaff', [AdminController::class, 'storeStaffMember'])->name('storeStaffMember');

    Route::post('/deleteUsers', [UserController::class, 'deleteUsers'])->name('deleteUsers');

    //Route::get('/generateBloodReport', [ReportInvoiceController::class, 'generateBloodReport'])->name('generateBloodReport');

    Route::get('/hospitals', [HospitalController::class, 'viewHospitals'])->name('viewHospitals');
    Route::post('/addHospitals', [HospitalController::class, 'storeHospitals'])->name('storeHospitals');

    //Route::get('/manageAppointments', [AdminController::class, 'ViewControlAppointment'])->name('ViewControlAppointment');

    Route::get('/addWorkingHours', [WorkingHoursController::class, 'viewAddWorkingHours'])->name('viewAddWorkingHours');
    Route::post('/storeWorkingHours', [WorkingHoursController::class, 'storeWorkingHours'])->name('storeWorkingHours');

    Route::get('/addBloodTypes', [BloodTypeController::class, 'viewAddBloodTypes'])->name('viewAddBloodTypes');
    Route::post('/storeBloodTypes', [BloodTypeController::class, 'storeBloodTypes'])->name('storeBloodTypes');
    Route::post('/deleteBloodTypes', [BloodTypeController::class, 'deleteBloodTypes'])->name('deleteBloodTypes');

   

});



Route::middleware('auth')->group(function () {

    Route::get('/becomeDonor', [UserController::class, 'viewBecomeDonor'])->name('viewBecomeDonor');
    Route::post('/StoreDonor', [UserController::class, 'StoreDonor'])->name('StoreDonor');

    Route::get('/makeAppointment', [DonorController::class, 'viewMakeAppointment'])->name('viewMakeAppointment');
    Route::post('/storeAppointment', [DonorController::class, 'storeAppointment'])->name('storeAppointment');
    Route::post('/changeAppointmentStatus', [DonorController::class, 'changeAppointmentStatus'])->name('changeAppointmentStatus');
    Route::post('/changeAvailabilityStatus', [DonorController::class, 'changeAvailabilityStatus'])->name('changeAvailabilityStatus');

    Route::get('/BecomeHcStaff', [UserController::class, 'viewBecomeHcStaff'])->name('viewBecomeHcStaff');
    Route::post('/storeHcStaff', [UserController::class, 'storeHcStaff'])->name('storeHcStaff');

    Route::get('/requestBloodUnits', [BloodRequestController::class, 'viewRequestBloodUnits'])->name('viewRequestBloodUnits');
    Route::post('/storeRequestBloodUnits', [BloodRequestController::class, 'storeRequestBloodUnits'])->name('storeRequestBloodUnits');

    Route::post('/changeBloodRequestStatus', [BloodRequestController::class, 'changeBloodRequestStatus'])->name('changeBloodRequestStatus');

    Route::get('/ratings', [RatingsController::class, 'viewRatings'])->name('viewRatings');
    Route::post('/storeRatings', [RatingsController::class, 'storeRatings'])->name('storeRatings');

});








