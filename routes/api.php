<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRegistration;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RegisterExam;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
//registration process with token generation
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/verify-otp', [RegisterController::class, 'verifyOtp']);
Route::post('/login',LoginController::class);
//Route::get('/logout',[LogoutController::class,'logout']);

Route::post('/uploads', [ImageController::class, 'upload']);
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:api');
//Middleware Only logged in user can perforn task
Route::middleware(['auth:api', 'role:user'])->group(function(){
    Route::post('/students',[PersonalController::class,'personalDetails']);
    Route::post('/contact',[PersonalController::class,'contactDetail']);
    Route::post('/educations',[PersonalController::class,'education']);
    Route::post('/manage', [PersonalController::class, 'manage']);
    Route::delete('/del/{title}',[PersonalController::class,'deleteManage']);
    Route::delete('/educations/del/{id}',[PersonalController::class,'edudelete']);
    Route::get('/edupreview/{id}',[PersonalController::class,'educationPreview']);
    Route::get('/educations/preview/{user_id}',[PersonalController::class,'getpreview']);
    Route::post('/edu',['EducationController::class','educations']);
    Route::post('/edupreview',['EducationController::class','edupreview']);
    Route::get('/pre/{user_id}',[PersonalController::class,'preview']);
    //ExamRegistration process needed routes
    Route::post('/registerexam',[RegisterExam::class,'registerexam']);

});
//Admin login and registration using passport for authentication.....!
    Route::post('/admin/register',[AdminRegistration::class,'adminRegistration']);
    Route::post('/admin/login',[AdminController::class,'adminlogin']);
    Route::middleware(['auth:api', 'role:admin'])->group(function(){});

//Resource class
Route::get('/url/{id}',[PersonalController::class,'url']);
Route::get('/urls',[PersonalController::class,'urls']);
Route::get('/manageurl',[PersonalController::class,'manageurl']);

//Admin site work ()
Route::post('/admin/subject',[SubjectController::class,'addSubjects']);

Route::get('/sees/{semester}',[RegisterExam::class,'seesubjects']);

