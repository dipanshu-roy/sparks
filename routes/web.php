<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\DesignationCOntroller;
use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\Admin\ManageSchoolController;
use App\Http\Controllers\Web\CommonController;
use App\Http\Controllers\Web\OtpVerifyController;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Web\SchoolDetailsController;
use App\Http\Controllers\Web\HeadofSchoolController;
use App\Http\Controllers\Web\SparkCordinatorController;
use App\Http\Controllers\Web\SchollenrolmentController;
use App\Http\Controllers\Web\GenrateController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\School\SchoolLoignController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.home');
});

Route::get('/login', function () {
    return view('admin/auth-signin');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/school-dashboard', function () {
    return view('school.dashboard');
  //return "success";
})->name('school.dashboard');

Route::middleware('auth')->group(function () {
   // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('designation', DesignationCOntroller::class);
    Route::resource('board', BoardController::class);
    Route::resource('title', TitleController::class);
    Route::get('mange-school',[ManageSchoolController::class,'index'])->name('manage.school');
    Route::get('mange-view/{id}',[ManageSchoolController::class,'view'])->name('manage.school.view');
});
Route::get('school-login', [SchoolLoignController::class, 'index'])->name('school-login'); 
Route::post('school-login', [SchoolLoignController::class, 'store']); 
Route::post('school-logout', [SchoolLoignController::class, 'destroy'])->name('school.logout'); 
Route::post('register-store', [RegistrationController::class, 'store'])->name('register.store');
Route::post('/otp-verify', [OtpVerifyController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/resend-otp', [RegistrationController::class, 'store'])->name('otp.resend');
Route::post('/school/save', [SchoolDetailsController::class, 'store'])->name('school.store');
Route::post('save-head-of-school', [HeadofSchoolController::class, 'store'])->name('save.head.of.school');
Route::post('save-spark-cordinator', [SparkCordinatorController::class, 'store'])->name('save.spark.cordinator');
Route::post('school-enroll-save', [SchollenrolmentController::class, 'store'])->name('school_enroll.save');
Route::post('thank-you', [GenrateController::class, 'store'])->name('finel.save'); 
Route::post('save-as-draft', [GenrateController::class, 'saveDraft'])->name('save.as.draft'); 
Route::get('/schools/autocomplete', [SchoolDetailsController::class, 'autocomplete'])->name('schools.autocomplete');


Route::get('school-registration', [CommonController::class, 'index1'])->name('index1.create'); 
Route::get('verify-otp',[CommonController::class, 'index2'])->name('otp.verify.form'); 
Route::get('school-create', [CommonController::class, 'index3'])->name('school.create');
Route::get('head-of-school-info', [CommonController::class, 'index4'])->name('head.of.school');
Route::get('spark-cordinator', [CommonController::class, 'index5'])->name('spark.cordinator');
Route::get('school-enroll', [CommonController::class, 'index6'])->name('school_enroll.create');
Route::get('/get-districts/{state_id}', [CommonController::class, 'getDistricts']);
Route::get('/get-cities/{district_id}', [CommonController::class, 'getCities']);

Route::post('send-otp-mobile', [CommonController::class, 'sendOtpMobile']);
Route::post('verify-otp-mobile', [CommonController::class, 'verifyOtpMobile']);

Route::post('send-otp-email', [CommonController::class, 'sendOtpEmail']);
Route::post('verify-otp-email', [CommonController::class, 'verifyOtpEmail']);
Route::get('get-subject/{state_id}', [CommonController::class, 'Getsubject']);

Route::get('school-login/{code}', [SchoolLoignController::class, 'index'])->name('school.login.code');
Route::get('school-login/{code}/{codex}', [SchoolLoignController::class, 'student'])->name('school.login.codex');
Route::get('student-form', [StudentController::class, 'create'])->name('students.create');
Route::post('store-student-form', [StudentController::class, 'store'])->name('students.store');
Route::get('register-successfully', [StudentController::class, 'register_successfully'])->name('register.successfully');


require __DIR__.'/auth.php';
