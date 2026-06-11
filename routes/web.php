<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserInviteController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // user invitation
   Route::get('/invite-user', [UserInviteController::class, 'create'])->name('invite-user.create');

   Route::post('/invite-user', [UserInviteController::class, 'store'])->name('invite-user.store');
});

   
Route::get('/accept-invitation', [InvitationController::class, 'show'])
    ->middleware('signed')
    ->name('invitation.accept');

Route::post('/accept-invitation', [InvitationController::class, 'register'])
    ->name('invitation.register');

Route::middleware(['auth','role:Super Admin'])->group(function () {

    Route::resource(
        'companies',
        CompanyController::class
    );

});
Route::get("/short-urls-list",[ShortUrlController::class,'index'])->name('short-urls.list')->middleware(['auth','role:Super Admin|Admin|Member']);
Route::middleware(['auth','role:Admin|Member'])->group(function(){
    Route::get("/create-short-url",[ShortUrlController::class,'create'])->name('short-urls.create');
    Route::post("/short-urls-store",[ShortUrlController::class,'store'])->name("short-urls.store");
});

Route::get('/s/{shortCode}', [ShortUrlController::class, 'redirect'])->name('short-url.redirect');

require __DIR__.'/auth.php';
