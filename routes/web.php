<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AddInformation;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\AddInformationUser;
use App\Http\Controllers\AdminDepartment\AddInformationAdminDepart;
use App\Http\Controllers\Admin\AddInformationAdmin;

use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginAdminDepartmentController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StylizedController;
use App\Http\Controllers\Admin\ReviewStylizedController;
use App\Http\Controllers\Admin\ReviewDetailStylizedController;
use App\Http\Controllers\Admin\SlideShowController;

use App\Http\Controllers\AdminDepartment\AdminDepartmentController;
use App\Http\Controllers\AdminDepartment\UserDepartController;
use App\Http\Controllers\AdminDepartment\StylizedDepartController;
use App\Http\Controllers\AdminDepartment\DetailRegistrationController;

use App\Http\Controllers\User\MainUserController;
use App\Http\Controllers\User\RegisterStylizedController;
use App\Http\Controllers\User\SendStylizedController;




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


Route::get('/', [UserLoginController::class, 'getLogin'])->name('get_login');
// Login for users
Route::get('/login-user', [UserLoginController::class, 'getLogin'])->name('get_login');
Route::post('/login-user', [UserLoginController::class, 'postLogin']);
// Add information after first time login
Route::resource('/add-information', AddInformationUser::class);
Route::post('/add-information/add-infor/{id}', [AddInformationUser::class, 'addInformationUser'])->name('addInformationUser');
//Register
Route::resource('/register', RegisterController::class);
Route::post('/register/regis', [RegisterController::class,'postRegister'])->name('postRegister');



Route::get('/logout-user', [UserLoginController::class, 'getLogout']);

// ===============================USER====================================
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    //Information user
    Route::get('/information-user', [HomeController::class, 'inforUser'])->name('inforUser');
    Route::get('/change-password', [HomeController::class, 'changePassGet'])->name('changePassGet');
    Route::get('/download-file/{filename}', [HomeController::class, 'downloadFileUser'])->name('downloadFileUser');
    
    //Change information user
    
    Route::get('/change-information', [HomeController::class, 'changeInforGet'])->name('changeInforGet');
    Route::post('/change-information/{id}', [HomeController::class, 'changeInforPost'])->name('changeInforPost');
    Route::post('/change-information/change-pass/{id}', [HomeController::class, 'changePassPost'])->name('changePassPost');
    Route::post('/change-information/change-image/{id}', [HomeController::class, 'changeImage'])->name('changeImage');

    //register stylized
    Route::get('/register-stylized/{id}', [RegisterStylizedController::class, 'getStylized'])->name('getStylized');
    Route::post('/register-stylized/registration', [RegisterStylizedController::class, 'storeRegistration'])->name('storeRegistration');
    //Manage registed stylized 
    Route::resource('/send-stylized', SendStylizedController::class);
    Route::get('/send-stylized/show/{id}', [SendStylizedController::class, 'showDetail'])->name('showDetail');
    Route::post('/send-stylized/update/{id}', [SendStylizedController::class, 'updateDetail'])->name('updateDetail');
    Route::get('/send-stylized/delete/{id}', [SendStylizedController::class, 'deleteDetail'])->name('deleteDetail');
    Route::get('/refresh-notification', [SendStylizedController::class, 'loadPart'])->name('loadPart');
});

//=============================ADMIN-DEPARTMENT===========================
//Login admin-department
Route::get('/login-admin-department', [LoginAdminDepartmentController::class, 'getLogin'])->name('loginAdminDepartment');
Route::post('/login-admin-department', [LoginAdminDepartmentController::class, 'postLogin'])->name('postLoginDepart');
//Add information after first time login
Route::resource('/add-information-admindepart', AddInformationAdminDepart::class);
Route::post('/add-information-admindepart/add-infor/{id}', [AddInformationAdminDepart::class, 'addInformationAdminDepartment'])->name('addInformationAdminDepartment');
// Logout admin-department
Route::get('/logout-admin-department', [LoginAdminDepartmentController::class, 'getLogout']);

Route::prefix('admin-department')->middleware('adminDepartMiddle')->group(function () {
    Route::get('/', [AdminDepartmentController::class, 'homeAdminDepart'])->name('admin-department.home');
    //Information admin-department 
    Route::get('/information-user', [AdminDepartmentController::class, 'inforUser'])->name('inforUser');
    Route::get('/change-password', [AdminDepartmentController::class, 'changePassGet'])->name('changePassGet');
    Route::get('/download-file/{filename}', [AdminDepartmentController::class, 'downloadFileAdminDepart'])->name('downloadFileAdminDepart');
    
    //Change admin-department's information
    
    Route::get('/change-information', [AdminDepartmentController::class, 'changeInforAdminDepartmentGet'])->name('changeInforAdminDepartmentGet');
    Route::post('/change-information/{id}', [AdminDepartmentController::class, 'changeInforAdminDepartmentPost'])->name('changeInforAdminDepartmentPost');
    Route::post('/change-information/change-pass/{id}', [AdminDepartmentController::class, 'changePassAdminDepartment'])->name('changePassAdminDepartment');
    Route::post('/change-information/change-image/{id}', [AdminDepartmentController::class, 'changeImageAdminDepartment'])->name('changeImageAdminDepartment');
    // Change user's infromation in that department 
    Route::resource('/user-department', UserDepartController::class);
    Route::post('/user-department/{id}', [UserDepartController::class,'edit']);
    Route::get('/user-department/{id}', [UserDepartController::class,'show']);
    Route::get('/user-department/accept/{id}', [UserDepartController::class,'acceptUser'])->name('acceptUser');
    Route::get('/user-department/accept-many/{id}', [UserDepartController::class,'acceptManyUsers'])->name('acceptManyUsers');
    Route::get('/user-department/refuse/{id}', [UserDepartController::class,'refuseUser'])->name('refuseUser');
    
    Route::post('/user-department/change-pass-user/{id}', [UserDepartController::class,'changePassUser'])->name('changePassUser');
    Route::post('/user-department/change-status-user/{id}', [UserDepartController::class,'changeStatusUserAdminDepart'])->name('changeStatusUserAdminDepart');
    
    //Xét duyệt cấp khoa
    Route::resource('/stylized-department', StylizedDepartController::class);
    Route::get('/stylized-department/download-file/{id}', [StylizedDepartController::class, 'dowloadFile']);
    Route::get('/stylized-department/download-declare-file/{id}', [StylizedDepartController::class, 'dowloadDeclareFile']);
    Route::post('/stylized-department/delete/{id}', [StylizedDepartController::class, 'destroy']);

    Route::get('/stylized-department-detail/{id}', [DetailRegistrationController::class, 'showDetailCeriteria'])->name('showDetailCeriteria');
    Route::post('/stylized-update-detail/{id}', [DetailRegistrationController::class, 'updateRegistrationDetail'])->name('updateRegistrationDetail');

});

// =================================ADMIN=================================

// Login admin
Route::get('/login-admin', [LoginAdminController::class, 'getLogin'])->name('login_admin');
Route::post('/login-admin', [LoginAdminController::class, 'postLogin']);
// Logout admin
Route::get('/logout-admin', [LoginAdminController::class, 'getLogout']);
//Add information after first time login
Route::resource('/add-information-admin', AddInformationAdmin::class);
Route::post('/add-information-admin/add-infor/{id}', [AddInformationAdmin::class, 'addInformationAdmin'])->name('addInformationAdmin');


Route::prefix('admin')->middleware('adminMiddle')->group(function () {
    Route::get('/', [AdminController::class, 'dasboard'])->name('mainAdmin');

    // Manage Admin's information 
    Route::get('/change-information', [AdminController::class, 'changeInforAdminGet'])->name('changeInforAdminGet');
    Route::post('/change-information/{id}', [AdminController::class, 'changeInforAdminPost'])->name('changeInforAdminPost');
    Route::post('/change-information/change-pass/{id}', [AdminController::class, 'changePassAdmin'])->name('changePassAdmin');
    Route::post('/change-information/change-image/{id}', [AdminController::class, 'changeImageAdmin'])->name('changeImageAdmin');


    // Manage Admin-department information 
    Route::resource('/department', DepartmentController::class);
    Route::get('/department/{id}', [DepartmentController::class, 'edit']);
    Route::post('/department/{id}', [DepartmentController::class, 'update']);
    Route::post('/department/change-pass-admindepart/{id}', [DepartmentController::class,'changePassAdmindepart'])->name('changePassAdmindepart');
    Route::post('/department/change-status-admindepart/{id}', [DepartmentController::class,'changeStatusDepart'])->name('changeStatusDepart');

    
    // Manage user information
    Route::resource('/user', UserController::class);
    Route::post('/user/{id}', [UserController::class, 'update']);
    Route::post('/user/change-pass-user/{id}', [UserController::class,'changePassUserAdmin'])->name('changePassUserAdmin');
    Route::post('/user/change-status-user/{id}', [UserController::class, 'changeStatusUser'])->name('changeStatusUser');

    //Manage years, competition period, stylized
    Route::resource('/stylized', StylizedController::class);
    // Add new scholastic (Thêm năm học mới)
    Route::post('/stylized', [StylizedController::class, 'addNewYear'])->name('addNewYear');
    // Add new competition period (Tạo mới đợt thi đua)
    Route::post('/stylized/add-competition', [StylizedController::class, 'addCompetition'])->name('addCompetition');
    // Manage competition period (Cập nhật đợt thi đua)
    Route::post('/stylized/update-competition/{id}', [StylizedController::class, 'updateCompetitionPeriod'])->name('updateCompetitionPeriod');
    Route::get('/stylized/delete-competition/{id}', [StylizedController::class, 'deleteCompetitionPeriod'])->name('deleteCompetitionPeriod');
    // Add new stylized (Thêm danh hiệu mới)
    Route::post('/stylized/new-stylized', [StylizedController::class, 'addNewStylized'])->name('addNewStylized');
    // Update Stylized 
    Route::post('/stylized/update-stylized/{id}', [StylizedController::class, 'updateStylized'])->name('updateStylized');
    //Download intruction file (Tải file hướng dẫn)
    Route::get('/stylized/dowload-file/{filename}', [StylizedController::class, 'downloadFile'])->name('downloadFile');
    //Delete stylized 
    Route::get('/stylized/delete-stylized/{id}', [StylizedController::class, 'deleteStylized'])->name('deleteStylized');
    
    Route::post('/stylized/{id}', [StylizedController::class, 'update']);
    Route::get('/stylized/update-status/{id}/status/{status}', [StylizedController::class, 'updateStatus'])->name('stylized.update.status');
    
   

    // Xét duyệt cấp trường
    Route::resource('/review-stylized', ReviewStylizedController::class);
    Route::get('/review-detail-stylized/{id}', [ReviewDetailStylizedController::class,'showDetailCeriteriaAdmin'])->name('showDetailCeriteriaAdmin');
    Route::post('/review-detail-stylized/{id}', [ReviewDetailStylizedController::class,'updateRegistrationDetailAdmin'])->name('updateRegistrationDetailAdmin');
    
    // SlideShow
    Route::resource('/update-slideshow', SlideShowController::class);
    Route::post('/update-slideshow/change-slide', [SlideShowController::class, 'slideShow'])->name('slideShow');
    Route::get('/update-slideshow/delete-image/{name}', [SlideShowController::class, 'deleteImages'])->name('deleteImages');
    Route::post('/update-slideshow/add-images', [SlideShowController::class, 'uploadImages'])->name('uploadImages');
    

});
