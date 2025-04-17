<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuditCheckerController;

// Login routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->middleware('auth')->name('dashboard');;

    // Audit
    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
    Route::get('/audit/create', [AuditController::class, 'create'])->name('audit.create');
    Route::post('/audit', [AuditController::class, 'store'])->name('audit.store');
    Route::get('/audit/{audit}/edit', [AuditController::class, 'edit'])->name('audit.edit');
    Route::put('/audit/{audit}', [AuditController::class, 'update'])->name('audit.update');
    Route::delete('/audit/{audit}', [AuditController::class, 'destroy'])->name('audit.destroy');

    // Audit Checkers
    Route::get('/auditchecker', [AuditCheckerController::class, 'index'])->name('auditchecker.index');
    Route::get('/auditchecker/create', [AuditCheckerController::class, 'create'])->name('auditchecker.create');
    Route::post('/auditchecker', [AuditCheckerController::class, 'store'])->name('auditchecker.store');
    Route::get('/auditchecker/{auditchecker}/edit', [AuditCheckerController::class, 'edit'])->name('auditchecker.edit');
    Route::put('/auditchecker/{auditchecker}', [AuditCheckerController::class, 'update'])->name('auditchecker.update');
    Route::delete('/auditchecker/{auditchecker}', [AuditCheckerController::class, 'destroy'])->name('auditchecker.destroy');
    Route::post('/auditchecker/storeFromTable', [AuditCheckerController::class, 'storeFromTable'])->name('auditchecker.storeFromTable');
});
