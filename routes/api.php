<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CommentaryController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\Tbl_user_commentaryController;
use App\Http\Controllers\API\Tbl_profile_jobController;

//Login y registro
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('recoverpassword', [AuthController::class, 'recoverPassword']);

//Ver todo lo que hay en una tabla
Route::get('category/all', [CategoryController::class, 'index']);
Route::get('job/all', [JobController::class, 'index']);
Route::get('commentary/all', [CommentaryController::class, 'index']);
Route::get('contact/all', [ContactController::class, 'index']);
Route::get('rating/all', [RatingController::class, 'index']);
Route::get('profile/all', [ProfileController::class, 'index']);
Route::get('profile_commentary/all', [Tbl_user_commentaryController::class, 'index']);
Route::get('profile_job/all', [Tbl_profile_jobController::class, 'index']);

//Ver una unica fila de la tabla
Route::get('profile_job/{profiles_id}', [Tbl_profile_jobController::class, 'show']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::get('job/{id}', [JobController::class, 'show']);
Route::get('commentary/{id}', [CommentaryController::class, 'show']);
Route::get('profile/{id}', [ProfileController::class, 'show']);
Route::get('user/{id}', [ProfileController::class, 'show']);

Route::post('profile/store', [ProfileController::class, 'store']);
Route::post('contact/store', [ContactController::class, 'store']);
Route::post('rating/store', [RatingController::class, 'store']);
Route::post('job/store', [JobController::class, 'store']);
Route::post('profile_job/store', [Tbl_profile_jobController::class, 'store']);

Route::get('category/{id}', [CategoryController::class,'show']);
Route::get('category_id/{nameCategory}', [CategoryController::class,'show_id']);

Route::get('profile_job_filter/{id}', [Tbl_profile_jobController::class, 'show_id']);

Route::get('profile_filter/{id}', [ProfileController::class, 'show_id']);

Route::get('job/destroy/{id}', [JobController::class, 'destroy']);
Route::get('profile_job/destroy/{job_id}', [Tbl_profile_jobController::class, 'destroy']);

Route::put('job/update/{id}', [JobController::class, 'update']);
Route::put('profile/update/{id}', [ProfileController::class, 'update']);

//filtro por categoria
Route::get('jobfilter/{id}', [JobController::class, 'categoryJob']);
Route::get('jobfilter/{costMin}/{costMax}', [JobController::class, 'costJob']);
Route::get('jobfilterName/{letter}', [JobController::class, 'filterJobName']);

//TODOS LAS RUTAS APIS DENTRO DE SANCTUM DEBEN TENER VALIDACION DE USUARIO
Route::middleware('auth:sanctum')->group( function () {
    //Hacer logout del usuario
    Route::get('/logout', [AuthController::class, 'logout']);

    //Guardar en una tabla
    Route::post('category/store', [CategoryController::class, 'store']);

    Route::post('commentary/store', [CommentaryController::class, 'store']);

//    Route::post('contact/store', [ContactController::class, 'index']);
//    Route::post('rating/store', [RatingController::class, 'index']);

    Route::post('profile_commentary/store', [Tbl_user_commentaryController::class, 'store']);



    //Eliminar en una tabla especifica
    Route::post('categories/destroy', [CategoryController::class, 'destroy']);
    Route::post('jobs/destroy', [JobController::class, 'destroy']);
    Route::post('commentaries/destroy', [CommentaryController::class, 'destroy']);
});
