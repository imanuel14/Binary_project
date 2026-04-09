<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\GalleryController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController; 
use App\Http\Controllers\Admin\ChurchProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\JemaatController;


// ==================== PUBLIC ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('/programs/category/ibadah', [ProgramController::class, 'ibadah'])->name('programs.ibadah');
Route::get('/programs/category/pendidikan', [ProgramController::class, 'pendidikan'])->name('programs.pendidikan');

Route::get('/tentang/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/tentang/galeri/{category}', [GalleryController::class, 'category'])->name('gallery.category');


// ==================== AUTHENTICATION ====================
// Login (Hanya bisa diakses jika belum login)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// LOGOUT GLOBAL (Bisa dipakai Admin maupun User)
// Letakkan di luar prefix agar namanya murni 'logout'
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==================== USER AREA ====================
Route::middleware(['auth']) // Cukup gunakan auth:web dulu untuk tes
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // 1. Dashboard - Gunakan Controller yang sudah kita bahas
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // 2. Programs - Arahkan ke Controller khusus folder User (Jika sudah dibuat)
        // Jika belum buat folder User, pastikan ProgramController publik tidak punya middleware 'guest'
        Route::resource('programs', App\Http\Controllers\ProgramController::class);
        // Route::resource('programs', ProgramController::class);
        // Di dalam Route::group(['prefix' => 'user', ...])
        Route::get('/programs', [ProgramController::class, 'userIndex'])->name('programs.index');
        Route::get('/programs/create', [ProgramController::class, 'userCreate'])->name('programs.create');
        Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/programs/{program}/edit', [ProgramController::class, 'userEdit'])->name('programs.edit');
        Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

        // 3. Profil Gereja - JANGAN panggil Controller Admin langsung
        // Buat method edit di UserDashboardController atau buat Controller baru di folder User
        Route::get('/church-profile', [UserDashboardController::class, 'editProfile'])->name('church-profile.edit');
        Route::put('/church-profile', [UserDashboardController::class, 'updateProfile'])->name('church-profile.update');

        // 4. Kontak
        Route::get('/contacts', [ContactController::class, 'userIndex'])->name('contacts.index');
        Route::get('/contacts/{contact}', [ContactController::class, 'userShow'])->name('contacts.show');
        Route::delete('/contacts/{contact}', [ContactController::class, 'userDestroy'])->name('contacts.destroy');
    });

// ==================== ADMIN AREA ====================
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);

        // Satu baris Route::resource() otomatis generate 7 route (index, create, store, show, edit, update, destroy).
        Route::resource('programs', AdminProgramController::class);
        // Route::get('/programs', [ProgramController::class, 'Index'])->name('programs.index');
        // Route::get('/programs/create', [ProgramController::class, 'Create'])->name('programs.create');
        // Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
        // Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
        // Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
        // Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

        Route::resource('contacts', AdminContactController::class);
        // Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        // Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
        // Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
        // Route::patch('/contacts/{contact}/read', [AdminContactController::class, 'markAsRead'])->name('contacts.read');

        Route::get('/church-profile', [ChurchProfileController::class, 'edit'])->name('church-profile.edit');
        Route::put('/church-profile', [ChurchProfileController::class, 'update'])->name('church-profile.update');

        Route::resource('jemaats', \App\Http\Controllers\Admin\JemaatController::class);

        // Satu baris Route::resource() otomatis generate 7 route (index, create, store, show, edit, update, destroy).
        Route::resource('jemaats', JemaatController::class);
        Route::get('jemaats/export/data', [JemaatController::class, 'export'])->name('jemaats.export');
        Route::get('/jemaats/export/pdf', [JemaatController::class, 'exportPdf'])->name('jemaats.export.pdf');
        Route::get('/jemaats/export/excel', [JemaatController::class, 'exportExcel'])->name('jemaats.export.excel');

        Route::resource('galleries', AdminGalleryController::class);

        // Otomatis buat index, create, store, edit, update, destroy
        Route::resource('gallery', GalleryController::class);
    });
