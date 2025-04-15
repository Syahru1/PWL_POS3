<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter id, maka harus berupa angka

// Routes for login (auth.login)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Menampilkan halaman register
Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Proses registrasi
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu
    // Routes for dashboard (welcome.blade.php)
    Route::get('/', [WelcomeController::class, 'index']);

    Route::get('/level', [LevelController::class, 'index']);
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/tambah', [UserController::class, 'tambah']);
    Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan'])->name('user.tambah_simpan');
    Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
    // Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
    Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan'])->name('user.ubah_simpan');
    Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');
    
     // Routes for User
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);           // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);       // menampilkan data user dalam bentuk json untuk datatables   
        Route::get('/create', [UserController::class, 'create']);    // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);          // menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
        Route::get('/{id}', [UserController::class, 'show']);        // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);   // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);      // menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);   // Untuk tampilan form confirm delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
        Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
        Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
    });

    // Routes for Level
    // artinya ssemua route di dalam group ini harus punya role ADM (Administrator)
    // Route::middleware(['authorize:ADM'])->group(function () {
        // Route::prefix('level')->group(function () {
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']);          
            Route::post('/list', [LevelController::class, 'list']);        
            Route::get('/create', [LevelController::class, 'create']);    
            Route::post('/', [LevelController::class, 'store']);          
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']); 
            Route::post('/ajax', [LevelController::class, 'store_ajax']); 
            Route::get('/{id}', [LevelController::class, 'show']);        
            Route::get('/{id}/edit', [LevelController::class, 'edit']);   
            Route::put('/{id}', [LevelController::class, 'update']);      
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);  
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); 
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);   
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); 
            Route::delete('/{id}', [LevelController::class, 'destroy']);  
            Route::get('/import', [LevelController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
            Route::get('/export_excel', [LevelController::class, 'export_excel']); // export excel
        });
    // });
    
    // Routes for Kategori
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);          
        Route::post('/list', [KategoriController::class, 'list']);       
        Route::get('/create', [KategoriController::class, 'create']);    
        Route::post('/', [KategoriController::class, 'store']);          
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); 
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); 
        Route::get('/{id}', [KategoriController::class, 'show']);        
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);   
        Route::put('/{id}', [KategoriController::class, 'update']);      
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); 
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);   
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); 
        Route::delete('/{id}', [KategoriController::class, 'destroy']);  
        Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [KategoriController::class, 'export_excel']); // export excel
    });
    
    // Routes for Suplier
    // artinya semua route di dalam group ini harus punya role ADM (Administrator) dan MNG (Manager)
    // Route::middleware(['authorize:ADM, MNG'])->group(function () {
        Route::group(['prefix' => 'suplier'], function () {
            Route::get('/', [SupplierController::class, 'index']);         
            Route::post('/list', [SupplierController::class, 'list']);      
            Route::get('/create', [SupplierController::class, 'create']);    
            Route::post('/', [SupplierController::class, 'store']);          
            Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); 
            Route::post('/ajax', [SupplierController::class, 'store_ajax']); 
            Route::get('/{id}', [SupplierController::class, 'show']);        
            Route::get('/{id}/edit', [SupplierController::class, 'edit']);   
            Route::put('/{id}', [SupplierController::class, 'update']);      
            Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);  
            Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
            Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);   
            Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); 
            Route::delete('/{id}', [SupplierController::class, 'destroy']);  
            Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
            Route::get('/export_excel', [SupplierController::class, 'export_excel']); //  export excel
        });
    // });
    
    // Routes for Barang
    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), dan STF (Staff)
    // Route::middleware(['authorize:ADM, MNG, STF'])->group(function () {
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']);           
            Route::post('/list', [BarangController::class, 'list']);       
            Route::get('/create', [BarangController::class, 'create']);    
            Route::post('/', [BarangController::class, 'store']);          
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); 
            Route::post('/ajax', [BarangController::class, 'store_ajax']); 
            Route::get('/{id}', [BarangController::class, 'show']);        
            Route::get('/{id}/edit', [BarangController::class, 'edit']);   
            Route::put('/{id}', [BarangController::class, 'update']);     
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); 
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);   
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); 
            Route::delete('/{id}', [BarangController::class, 'destroy']);  
            Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
            Route::get('/export_excel', [BarangController::class, 'export_excel']); // export excel
        });
    // });
});
