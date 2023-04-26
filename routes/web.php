<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});
Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/user/dashboard', [HomeController::class, 'index']);
    Route::get('/user/new-ticket', [TicketsController::class, 'create']);
    Route::get('/user/my_tickets', [TicketsController::class, 'userTickets']);
    Route::get('/user/tickets/{ticket_id}', [TicketsController::class, 'show']);
    Route::post('/user/new-ticket', [TicketsController::class, 'store']);
    Route::post('/user/comment', [CommentsController::class, 'postComment']);
});
