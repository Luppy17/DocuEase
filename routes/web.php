<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileAdminController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileSharingController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
return view('welcome');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('hashpassword', function () {
$hashedPassword = Hash::make('P@ssw0rd');
dd($hashedPassword);
});

//Fileadmin & Manager
Route::get('/dashboard-fileadmin', [FileAdminController::class, 'index'])->name('dashboard-fileadmin');
Route::get('/docupdaproval', [FileAdminController::class, 'docupdaproval']);
Route::get('/docviewapproval', [FileAdminController::class, 'docviewapproval']);
Route::get('/dashboard-manager', [ManagerController::class, 'index'])->name('dashboard-manager');
Route::get('/docupdaprovalmanager', [ManagerController::class, 'docupdaproval']);
Route::get('/docviewapprovalmanager', [ManagerController::class, 'docviewapproval']);

//System Admin
Route::get('/dashboard-admin', [SystemAdminController::class, 'index'])->name('dashboard-admin');
Route::get('/userslist', [SystemAdminController::class, 'users'])->name('userslist');
Route::post('/users/store', [SystemAdminController::class, 'storeUser'])->name('users.store');
Route::get('/users/{id}', [SystemAdminController::class, 'showUser']);
Route::put('/users/update/{id}', [SystemAdminController::class, 'updateUser']);
Route::delete('/users/{id}', [SystemAdminController::class, 'destroyUser']);
Route::get('/departments/{id}', [SystemAdminController::class, 'showDept']);
Route::post('/departments/store', [SystemAdminController::class, 'storeDept']);
Route::put('/departments/update/{id}', [SystemAdminController::class, 'updateDept']);
Route::delete('/departments/{id}', [SystemAdminController::class, 'destroyDept']);
Route::get('/departmentlist', [SystemAdminController::class, 'department'])->name('departmentlist');

//Staff
Route::get('/dashboard-staff', [StaffController::class, 'index'])->name('dashboard-staff');
Route::get('/uploaded-by-me', [StaffController::class, 'indexme'])->name('uploaded-by-me');
Route::get('/recent-files', [StaffController::class, 'indexrecent'])->name('recent-files');
Route::get('/system-logs', [StaffController::class, 'logs'])->name('system-logs');
Route::get('viewfilestaff/{id}', [StaffController::class, 'viewfilestaff'])->name('files.view');

Route::get('/approved-files', [StaffController::class, 'indexapproved'])->name('approved-files');
Route::get('/rejected-files', [StaffController::class, 'indexrejected'])->name('rejected-files');
Route::get('/deleted-files', [StaffController::class, 'indexdeleted'])->name('deleted-files');

Route::group(['prefix' => 'files'], function () {
Route::post('upload', [FileController::class, 'upload']);
Route::post('folder/create', [FileController::class, 'createFolder']);
Route::post('folder/rename/{id}', [FileController::class, 'renameFolder']);
Route::delete('folder/delete/{id}', [FileController::class, 'deleteFolder']);
Route::get('view/{id}', [FileController::class, 'viewFile']);
Route::get('viewAdmin/{id}', [FileController::class, 'viewFileAdmin']);
Route::delete('delete/{id}', [FileController::class, 'deleteFile']);

// Approval Routes
Route::post('approve/{id}', [ApprovalController::class, 'approve']);
Route::post('reject/{id}', [ApprovalController::class, 'reject']);

// File Sharing Requests
Route::post('request-view', [FileSharingController::class, 'requestView']);
Route::post('request-approve/{id}', [FileSharingController::class, 'approveRequest']);
Route::post('request-reject/{id}', [FileSharingController::class, 'rejectRequest']);

Route::put('folder/rename/{id}', [FileController::class, 'renameFolder']);
Route::post('edit/{id}', [FileController::class, 'editFile']);
Route::get('get/{id}', [FileController::class, 'getFile']);
});

Route::get('/drive/folder/{id}', [FileController::class, 'openFolder'])->name('drive.openFolder');

Route::get('forbidden', function () {
    return view('Staff.403');
    })->name('forbidden');


Route::post('/files/star/{document}', [FileController::class, 'starDocument']);
Route::delete('/files/unstar/{document}', [FileController::class, 'unstarDocument']);

Route::get('/starred-files', [FileController::class, 'showStarredFiles']);


Route::get('/my-account', [UserController::class, 'showAccountManagementForm'])->name('my-account')->middleware('auth');
Route::post('/my-account/update-profile', [UserController::class, 'updateProfile'])->name('update-my-profile')->middleware('auth');
Route::post('/my-account/update-password', [UserController::class, 'updatePassword'])->name('update-my-password')->middleware('auth');
Route::delete('/my-account/delete', [UserController::class, 'deleteAccount'])->name('delete-my-account')->middleware('auth');





