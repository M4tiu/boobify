<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Symfony\Component\HttpFoundation\Request;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\Models\ChMessage;

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

Route::get('/', [UserController::class, 'index'])->name('main');

Route::get('/join', function(){
    return view('modelSubmission');
})->name('modelSubmission');

// Model routes
Route::get('/dashboard/{page}', [ModelController::class, 'index'])->name('dashboard');
Route::get('dashboard', function(){
    return redirect('dashboard/orders');
});
Route::post('create_service', [ModelController::class, 'create_service'])->name('create_service');
Route::get('delete_service/{id}', [ModelController::class, 'delete_service'])->name('delete_service');

//User routes
Route::get('/user_dashboard/{page}', [UserController::class, 'dashboard'])->name('user_dashboard');
Route::get('user_dashboard', function(){
    return view('user_dash.dashboard');
});

//Admin routes
Route::get('/adminPanel/{page}', [AdminController::class, 'index'])->name('adminPanel');
Route::get('adminPanel', function(){
    return redirect('adminPanel/orders');
});

Route::get('adminPanel/editUser/{id}', [AdminController::class, 'editUser'])->name('editUser');
Route::post('adminPanel/editUser/{id}', [AdminController::class, 'editUser'])->name('editUser');

//Order routes
Route::get('createOrder/{modelid}', [PaymentsController::class, 'createOrder'])->name('create_order');
Route::post('createOrder/{modelid}', [PaymentsController::class, 'createOrder'])->name('create_order');

Route::get('/retrieve', [PaymentsController::class, 'show']);
Route::Get('/webhooks', [PaymentsController::class, 'webhook']);

Auth::routes();


Route::get('test', function(){
    $modelid = User::where('name', 'Mateusz Dutkiewicz')->first(); 
    $userid = User::where('name', 'test')->first(); 

    $messageID = mt_rand(9, 999999999) + time();
    
    ChMessage::create([
        'id' => $messageID,
        'type' => 'user',
        'from_id' => 2,
        'to_id' => 1,
        'body' => 'test1241',
        'attachment' => null,
        'seen' => FALSE,
        "created_at" =>  \Carbon\Carbon::now(), 
        "updated_at" => \Carbon\Carbon::now(),
]);
});