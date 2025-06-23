<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\DesignationCOntroller;
use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\ManageSchoolController;
use App\Http\Controllers\Admin\ExamSheduleController;
use App\Http\Controllers\Web\CommonController;
use App\Http\Controllers\Web\OtpVerifyController;
use App\Http\Controllers\Web\RegistrationController;
use App\Http\Controllers\Web\SchoolDetailsController;
use App\Http\Controllers\Web\HeadofSchoolController;
use App\Http\Controllers\Web\SparkCordinatorController;
use App\Http\Controllers\Web\SchollenrolmentController;
use App\Http\Controllers\Web\GenrateController;
use App\Http\Controllers\School\SchoolLoignController;
use App\Http\Controllers\School\DashboardController;
use App\Http\Controllers\School\SchoolProfileController;
use App\Http\Controllers\School\ShareLinkController;
use App\Http\Controllers\School\StundetVerificationController;
use App\Http\Controllers\School\TechnicalAssesmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\StudentController;
use App\Http\Controllers\School\SchoolChangePassewordController;
Route::get('/', function () {
    return view('admin/auth-signin');
});

Route::get('register-your-school', function () {
    return view('web.home');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('check-login')->group(function () {
    
 Route::get('/school-dashboard',[DashboardController::class,'dashboard'])->name('school.dashboard');
 Route::get('/school-profile',[SchoolProfileController::class,'index'])->name('school.profile');
 Route::get('/school-share-link',[ShareLinkController::class,'index'])->name('school.share.link');
 Route::post('/store-school-share-link',[ShareLinkController::class,'store'])->name('store.school.share.link');
 Route::get('/student-verification',[StundetVerificationController::class,'index'])->name('student.verification');
 Route::get('/technical-assesment',[TechnicalAssesmentController::class,'index'])->name('technical.assesment');
 Route::post('/lab/checkbox/save', [App\Http\Controllers\LabCheckboxController::class, 'store'])
    ->name('lab.checkbox.save');
Route::post('logo-upload', [SchoolProfileController::class, 'upload_image'])->name('image.upload');  
Route::get('student-delete/{id}', [StundetVerificationController::class, 'destroy'])->name('student.delete');  
Route::put('/first/login/password/update', [SchoolChangePassewordController::class, 'update_password_after_login'])->name('first.password.update');
});
// Route::get('technical-assemetn',[SchoolProfileController::class,'index'])->name('school.profile');

//Route::prefix('school')->name('school.')->middleware(['auth:school', 'check.school.status'])->group(function () {
    //Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
   // Route::get('/profile', [SchoolProfileController::class, 'index'])->name('profile');
//});

 

Route::middleware('auth')->group(function () {

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    Route::resource('designation', DesignationCOntroller::class);
    Route::resource('board', BoardController::class);
    Route::resource('title', TitleController::class);
    Route::resource('class', ClassController::class);
    Route::resource('subject', SubjectController::class);
    Route::get('mange-school',[ManageSchoolController::class,'index'])->name('manage.school');
    Route::get('mange-view/{id}',[ManageSchoolController::class,'view'])->name('manage.school.view');
    Route::get('exam-date',[ExamSheduleController::class,'index'])->name('exam.date');
    Route::get('create-exam-date',[ExamSheduleController::class,'create'])->name('create.exam.date');
    Route::post('store-exam-date',[ExamSheduleController::class,'store'])->name('store.exam.date');
    Route::get('edit-exam-date/{id}',[ExamSheduleController::class,'edit'])->name('edit.exam.date');
    Route::post('update-exam-date/{id}',[ExamSheduleController::class,'update'])->name('update.exam.date');
    //route::get('exam-date');
});


 





Route::get('school-login', [SchoolLoignController::class, 'index'])->name('school-login'); 
Route::post('school-login', [SchoolLoignController::class, 'store']); 
Route::post('school-logout', [SchoolLoignController::class, 'destroy'])->name('school.logout'); 

// Route::get('/school-login/{code}', [SchoolLoignController::class, 'index'])->name('school-login');
// Route::get('/school-login/{code}/{codex}', [SchoolLoignController::class, 'student'])->name('school-login');


// Route::get('/student-form', [StudentController::class, 'create'])->name('students.create');
// Route::post('/store-student-form', [StudentController::class, 'store'])->name('students.store');
// Route::get('register-successfully', [StudentController::class, 'register_successfully'])->name('register.successfully'); 


Route::post('register-store', [RegistrationController::class, 'store'])->name('register.store');
Route::post('/otp-verify', [OtpVerifyController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/resend-otp', [RegistrationController::class, 'store'])->name('otp.resend'); 
Route::post('/school/save', [SchoolDetailsController::class, 'store'])->name('school.store');
 
Route::post('save-head-of-school', [HeadofSchoolController::class, 'store'])->name('save.head.of.school');
Route::post('save-spark-cordinator', [SparkCordinatorController::class, 'store'])->name('save.spark.cordinator'); 
Route::post('school-enroll-save', [SchollenrolmentController::class, 'store'])->name('school_enroll.save');
Route::post('school-enroll-edit/{id}', [SchollenrolmentController::class, 'edit'])->name('school_enroll.edit');

Route::post('thank-you', [GenrateController::class, 'store'])->name('finel.save'); 

 

Route::get('/get-subject/{state_id}', [CommonController::class, 'Getsubject']);
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

//21-06-2025
Route::post('/otp/resend', [CommonController::class, 'resend'])->name('otp.resend');
Route::get('check-verified-data', [CommonController::class, 'CheckVerifiedData']);

//21-06-2025

Route::get('school-login/{code}', [SchoolLoignController::class, 'index'])->name('school.login.code');
Route::get('school-login/{code}/{codex}', [SchoolLoignController::class, 'student'])->name('school.login.codex');
Route::get('student-form', [StudentController::class, 'create'])->name('students.create');
Route::post('store-student-form', [StudentController::class, 'store'])->name('students.store');
Route::get('register-successfully', [StudentController::class, 'register_successfully'])->name('register.successfully');

Route::get('Operating-System-and-Browser-Requirements', [CommonController::class, 'computer_requirement']);
Route::get('Memory-and-Network-Requirements', [CommonController::class, 'computer_requirement1']);


require __DIR__.'/auth.php';
