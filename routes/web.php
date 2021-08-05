<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
//alert
Route::get('my-notification/{type}', 'UserController@myNotification');
//login view
Route::view('login', 'login');
Route::post('loginFunction', [UserController::class, 'loginUser']);

//registration view
Route::view('register', 'register');
Route::post('registerMethod', [UserController::class, 'registerMethod']);

//resdetpassword
Route::view('forgetPassword', 'forgetPassword');
Route::post('resetPassword', [UserController::class, 'resetPassword']);

//normal_user view
Route::view('normal', 'normal');
//update mobile
Route::Post('updateMobile', [UserController::class, 'editMobile']);
//update normal address
Route::post('updateAddress', [UserController::class, 'updateAddress']);
//raise issue
Route::post('raiseIssue', [UserController::class, 'submitIssue']);

//manager screen

Route::get("test", [UserController::class, 'list']);
//to display employees under paticular manager
Route::get("showEmployeeCollection", [UserController::class, 'employeesList']);
//to delete employee from manager
Route::get("deleteEmp/{id}", [UserController::class, 'deleteEmployee']);
//adding employees to project by manger
Route::post("employeeInsert", [UserController::class, 'updateEmployeeFromManager']);
//to store issue details by manager
Route::post("mangerIssues", [UserController::class, 'managerIssue']);
//to update manager mobile
Route::post("managerMobileUpdate", [UserController::class, 'editManagerMobile']);
//to update manager address
Route::post("managerAddressUpdate", [UserController::class, 'editManagerAddress']);
Route::view('manager', 'manager');

//admin screen

Route::view('admin', 'admin');

// operate employee table by admin
Route::get("employeeProfile/{id}", [UserController::class, 'getEmpDetail']);
Route::get('delete/{id}', [UserController::class, 'removeEmployee']);
Route::post('addproject', [UserController::class, 'addProject']);
Route::get('projectInfo/{id}', [UserController::class, 'getProjectDetails']);
Route::view('projectInfo', 'projectInfo');
//update project by admin
Route::view('updateProject', 'updateProject');
Route::post('updateProjectbyadmin', [UserController::class, 'updateProject']);
//remove project by admin
Route::get('deleteProject/{id}', [UserController::class, 'removeProjectByAdmin']);

//solveissue
//Route::post('solveIssue',[UserController::class,'issueSolved']);
Route::get('resolve/{id}', [UserController::class, 'resolveIssue']);

Route::post('projectInformation', [UserController::class, 'allProject']);
// update employee by admin
Route::view('updateEmployee', 'updateEmployee');
Route::post('updateEmployees', [UserController::class, 'updateEmployee']);
//issue raise by admin
//Route::view('raiseIssueByAdmin','raiseIssueByAdmin');
Route::post('issueByAdmin', [UserController::class, 'submitIssueByAdmin']);
