<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', [AdminController::class, 'login'])->name('login');
Route::post('/auth', [AdminController::class, 'auth'])->name('auth');

//Role Admin
Route::middleware(['isLogin', 'cekRole:admin'])->group(function (){
    Route::get('/admin', [AdminController::class,'index'])->name('admin');
    Route::get('/admin.tambahuser', [AdminController::class,'create_user'])->name('admin.tambahuser'); //Halaman User
    Route::post('/register', [AdminController::class, 'register'])->name('register');
    Route::get('/edit/{id}', [AdminController::class, 'edit_user'])->name('edit');
    Route::patch('/update-user/{id}', [AdminController::class, 'update_user'])->name('update-user');
    Route::delete('/delete-user/{id}', [AdminController::class,'delete_user'])->name('delete-user');//end route user
    Route::get('/admin.produk', [AdminController::class,'product'])->name('admin.produk'); //Halaman Produk
    Route::get('/admin.tambahproduk', [AdminController::class,'create_product'])->name('admin.tambahproduk');
    Route::post('/store-product', [AdminController::class, 'store_product'])->name('store-product');
    Route::get('/edit-product/{id}', [AdminController::class,'edit_product'])->name('edit-product');
    Route::patch('/update-product/{id}', [AdminController::class, 'update_product'])->name('update-product');
    Route::patch('/update-stock/{id}', [AdminController::class, 'update_stock'])->name('update-stock');
    Route::delete('/delete-product/{id}', [AdminController::class, 'delete_product'])->name('delete-product');
    Route::get('/admin.penjualan', [AdminController::class, 'penjualan'])->name('admin.penjualan'); //Halaman Penjualan  
});
Route::get('/admin.user', [AdminController::class,'user'])->name('admin.user');



// // role kasir
Route::middleware(['isLogin', 'cekRole:employee'])->group(function () {
    Route::get('/employee', [EmployeeController::class,'index'])->name('employee');
    Route::get('/employee-product', [EmployeeController::class,'product'])->name('employee-product'); //Read produk
    Route::get('/employee-transaction', [EmployeeController::class,'transaction'])->name('employee-transaction'); //Halaman Transaksi Kasir
    Route::get('/add-transaction', [EmployeeController::class,'create'])->name('add-transaction');
    Route::post('/store-transaction', [EmployeeController::class,'store'])->name('store-transaction');
    Route::post('/save-transaction', [EmployeeController::class, 'save'])->name('save-transaction');
    Route::delete('/delete-transaction/{id}', [EmployeeController::class, 'delete'])->name('delete-transaction');

});
    
// Route::get('/admin', function (){
//     return view('admin.dashboard');
// }); 

// Route::get('/admin/user', function (){
//     return view('admin.tambahuser');
// }); 



// Route::get('/admin/produk', function (){
//     return view('admin.produk');
// }); 

// Route::get('/login', function () {
//     return view('/login');
// });

// Route::get('/', function () {
//     return view('login');
// });
