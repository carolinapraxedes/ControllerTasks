<?php

use App\Mail\MensagemMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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


/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')
->middleware('verified');*/
Route::resource('task',App\Http\Controllers\TaskController::class)
->middleware('verified');

Auth::routes(['verify'=>true]);

Route::get('mensagem',function(){
    return new MensagemMail;
    //Mail::to('carolinapraxedesdev@gmail.com')->send(new MensagemMail());
    //return 'E-mail enviado com sucesso';
});


