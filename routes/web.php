<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapsuleController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function() {

    Route::get('/', function () {
        return view('pages.index');
    })->name('landing');
    
    Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
    Route::get('/auth/register', [AuthController::class, 'register'])->name('register');

    Route::post('/auth/login', [AuthController::class, 'auth'])->name('auth');
    Route::post('/auth/register', [AuthController::class, 'createuser'])->name('register.create');
});

Route::middleware('auth')->group(function() {
    
    Route::get('/dashboard', function() {
    
        $capsules           = DB::select('SELECT * FROM capsules WHERE user_id = ?', [Auth::user()->id]);
        $locked_capsules    = DB::select('SELECT id FROM capsules WHERE user_id = ? AND unlock_date > ?', [Auth::user()->id, Carbon::now()->format('Y-m-d')]);
        $unlocked_capsules  = DB::select('SELECT id FROM capsules WHERE user_id = ? AND unlock_date <= ? AND readed_at IS NULL', [Auth::user()->id, Carbon::now()->format('Y-m-d')]);

        $data = [
            'capsules' => $capsules,
            'locked_capsules' => $locked_capsules,
            'unlocked_capsules' => $unlocked_capsules,
            'now' => Carbon::now()->format('Y-m-d')
        ];

        return view('pages.dashboard.index', $data);
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard/capsule/create', [CapsuleController::class, 'create'])->name('dashboard.capsule.create');
    Route::get('/dashboard/capsule/{id}/read', [CapsuleController::class, 'read'])->name('dashboard.capsule.read');
    Route::get('/dashboard/capsule/{id}/delete', [CapsuleController::class, 'delete'])->name('dashboard.capsule.delete');
    Route::get('/dashboard/capsule/{id}/edit', [CapsuleController::class, 'edit'])->name('dashboard.capsule.edit');

    Route::post('/dashboard/capsule/create', [CapsuleController::class, 'store'])->name('dashboard.capsule.store');

    Route::post('/dashboard/capsule/{id}/update', [CapsuleController::class, 'update'])->name('dashboard.capsule.update');



});
