<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('admin/projects1',\App\Http\Controllers\ResourceController::class)->middleware(['auth','auth_admin']);


Route::get('/projects/index',[App\Http\Controllers\HomePageController::class, 'index'])->middleware(['auth','auth_user'])->name('projects.index');
Route::get('/projects/index/{id}',[App\Http\Controllers\HomePageController::class, 'detail'])->middleware(['auth','auth_user'])->name('projects.detail');
Route::get('/projects/create',[App\Http\Controllers\HomePageController::class,'create'])->middleware(['auth','auth_user'])->name('projects.create');
Route::post('/projects/store',[App\Http\Controllers\HomePageController::class,'store'])->middleware(['auth','auth_user'])->name('projects.store');
Route::delete('/projects/destroy',[App\Http\Controllers\HomePageController::class,'deleteProject'])->name('projects.destroy');
Route::get('/projects/edit/{id}',[App\Http\Controllers\HomePageController::class,'edit'])->middleware(['auth','auth_user'])->name('projects.edit');
Route::put('/projects/update/{id}',[App\Http\Controllers\HomePageController::class,'update'])->middleware(['auth','auth_user'])->name('projects.update');


Route::get('/search',[App\Http\Controllers\HomePageController::class, 'search']);


Route::get('/admin/skills/create',[App\Http\Controllers\AdminSkillController::class, 'create'])->name('admin.skills.create');
Route::post('/admin/skills/store',[App\Http\Controllers\AdminSkillContAdminSkillControllerroller::class, 'store'])->name('admin.skills.store');
Route::get('/admin/skills/index',[App\Http\Controllers\AdminSkillController::class, 'index'])->name('admin.skills.index');
Route::delete('/admin/skills/destroy/{id}',[App\Http\Controllers\AdminSkillController::class, 'destroy'])->name('admin.skills.destroy');



Auth::routes();





