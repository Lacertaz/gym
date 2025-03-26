<?php

use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ManageAdminController;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GymPackageController;
use App\Http\Controllers\InfoGymController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\LogMembershipController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('/register-new-member', [LandingController::class, 'store'])->name('home.store');
Route::get('/registration-success', [LandingController::class, 'success'])->name('home.success');
Route::get('/gym-package', [LandingController::class, 'gym_package'])->name('home.gym_package');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('membership', MembershipController::class)
        ->only([
            'index',
            'create',
            'edit',
            'destroy',
        ])
        ->names([
            'index' => 'membership',
            'create' => 'membership.create',
            'edit' => 'membership.edit',
            'destroy' => 'membership.destroy',
        ])->middleware('role:super_admin|admin');
    Route::post('membership/reset-password/{id}', [MembershipController::class, 'reset_password'])->name('membership.reset-password');

    Route::resource('extend-membership', LogMembershipController::class)
        ->only([
            'index',
            'create',
            'store',
        ])
        ->names([
            'index' => 'extend-membership',
            'create' => 'extend-membership.create',
            'store' => 'extend-membership.store',
        ]);
    Route::post('extend-membership/proses_approve_reject/{id}/{type}', [LogMembershipController::class, 'proses_approve_reject'])->name('membership.proses_approve_reject')->middleware('role:super_admin|admin');

    Route::get('manage-admin', [ManageAdminController::class, 'index'])->name('manage-admin')->middleware('role:super_admin');
    Route::get('manage-admin/create', [ManageAdminController::class, 'create'])->name('manage-admin.create')->middleware('role:super_admin');
    Route::get('manage-admin/edit/{user}', [ManageAdminController::class, 'edit'])->name('manage-admin.edit')->middleware('role:super_admin');
    Route::delete('manage-admin/destroy/{user}', [ManageAdminController::class, 'destroy'])->name('manage-admin.destroy')->middleware('role:super_admin');
    Route::post('manage-admin/reset-password/{id}', [ManageAdminController::class, 'reset_password'])->name('manage-admin.reset-password')->middleware('role:super_admin');

    Route::get('manage-paket', [GymPackageController::class, 'index'])->name('manage-paket')->middleware('role:super_admin|admin');
    Route::get('manage-paket/create', [GymPackageController::class, 'create'])->name('manage-paket.create')->middleware('role:super_admin|admin');
    Route::get('manage-paket/edit/{gym_package}', [GymPackageController::class, 'edit'])->name('manage-paket.edit')->middleware('role:super_admin|admin');
    Route::delete('manage-paket/destroy/{gym_package}', [GymPackageController::class, 'destroy'])->name('manage-paket.destroy')->middleware('role:super_admin|admin');

    Route::get('manage-carousel', [CarouselController::class, 'index'])->name('manage-carousel')->middleware('role:super_admin|admin');
    Route::get('manage-carousel/create', [CarouselController::class, 'create'])->name('manage-carousel.create')->middleware('role:super_admin|admin');
    Route::get('manage-carousel/edit/{carousel}', [CarouselController::class, 'edit'])->name('manage-carousel.edit')->middleware('role:super_admin|admin');
    Route::delete('manage-carousel/destroy/{carousel}', [CarouselController::class, 'destroy'])->name('manage-carousel.destroy')->middleware('role:super_admin|admin');

    Route::get('info-gym', [InfoGymController::class, 'index'])->name('info-gym')->middleware('role:super_admin|admin');
    Route::post('info-gym/update', [InfoGymController::class, 'update'])->name('info-gym.update')->middleware('role:super_admin|admin');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
