<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Language routes
Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Manage leads
    Route::get('/edit-lead/{id}', [LeadController::class, 'edit'])->name('lead.edit');
    Route::post('/update-lead/{id}', [LeadController::class, 'update'])->name('lead.update');
    Route::delete('/delete-lead/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
    // Manage users
    Route::get('/user-list', [UserController::class, 'index'])->name('user.index');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/leads-max-sold', [SettingsController::class, 'max_sold_update'])->name('max_sold.update');
    Route::post('/budget', [SettingsController::class, 'budget_update'])->name('budget.update');
});
Route::middleware(['adminOrUser'])->group(function () {
    // Leads routes
    Route::get('/leads-list', [LeadController::class, 'index'])->name('lead.index');
    Route::get('/lead-details/{id}', [LeadController::class, 'show'])->name('lead.show');
    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // password update
    Route::post('password', [ProfileController::class, 'updatePassword'])->name('password.update');
    // Email settings update
    Route::post('/settings/{id}/update', [ProfileController::class, 'updateEmailSettings'])->name('email_settings.update');
    // Payment route
    Route::post('/leads/{id}/buy', [LeadController::class, 'buyLead'])->name('leads.buy');
    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/data', [TransactionController::class, 'getData'])->name('transactions.data');
});

require __DIR__.'/auth.php';
