<?php

use App\Http\Controllers\api\NotesController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UpdatePwdController;
use Illuminate\Auth\Events\Login;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
   Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('sendPasswordResetLink', 'App\Http\Controllers\PasswordResetRequestController@sendEmail');
    Route::post('resetPassword', 'App\Http\Controllers\ChangePasswordController@passwordResetProcess');
   // Route::post('/logout', [AuthController::class, 'logout']);
    //Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

/*  ----Normal routes without restriction-------
Route::get('displayNotes',[NotesController::class,'display_All']);
Route::get('particularNote/{id}',[NotesController::class,'display_Note']);
Route::post('createNote',[NotesController::class,'create_Note']);
Route::put('updateNote/{id}',[NotesController::class,'update_Note']);
Route::delete('deleteNote/{id}',[NotesController::class,'delete_Note']);
*/
Route::post('/register', [
    AuthController::class, 'register'
]);

Route::post('/login', [
    AuthController::class, 'login'
]);

/**-----getUser-Details---------- */
Route::get('/user', [
    AuthController::class, 'getUser'
])->middleware('auth.jwt');

/**-------Display-Notes------------- */
Route::get('/display', [
    NotesController::class,'display_All'
])->middleware('auth.jwt');

/** ------- Delete-Notes ------------- */
Route::delete('/delete/{id}', [
    NotesController::class,'delete_Note'
])->middleware('auth.jwt');

/**-----DisplayParticular-Notes---------*/
Route::get('/displaynote/{id}',[
    NotesController::class,'display_Note'
])->middleware('auth.jwt');

/**-----Createnew-Note----------- */
Route::post('/createnote',[
    NotesController::class,'create_Note'
])->middleware('auth.jwt');

/**-----Update-Note-------- */
Route::put('/updatenote/{id}',[
    NotesController::class,'update_Note'
])->middleware('auth.jwt');







//Group-Routes
Route::group(["middleware"=>['auth.jwt']],function(){
    Route::get('/usr',[AuthController::class,"listUsers"]);
   // Route::get("/users",[NotesController::class,"list"]);
    Route::get('displayNotes',[NotesController::class,'display_All']);
    Route::get('particularNote/{id}',[NotesController::class,'display_Note']);
    Route::post('createNote',[NotesController::class,'create_Note']);
    Route::put('updateNote/{id}',[NotesController::class,'update_Note']);
    Route::delete('deleteNote/{id}',[NotesController::class,'delete_Note']);
});