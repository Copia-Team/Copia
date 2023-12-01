<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//Masyarakat
Route::get('/', [App\Http\Controllers\masyarakat\DashboardController::class, 'index'])->name('home.masyarakat');
Route::get('/distribusi', [App\Http\Controllers\masyarakat\DistribusiController::class, 'distribusi']);
Route::get('/faq', [App\Http\Controllers\masyarakat\FaqController::class, 'faq'])->name('faq');
Route::post('/faq/submit', [App\Http\Controllers\masyarakat\FaqController::class, 'submitFaq'])->name('faq.submit');
Route::get('/kalkulator', [App\Http\Controllers\masyarakat\KalkulatorController::class, 'kalkulator']);
Route::prefix('cnowledge')->group(function () {
    Route::get('/', [App\Http\Controllers\masyarakat\CnowledgeController::class, 'posts'])->name('cnowledge.dashboard');
    Route::get('/post/{article:slug}', [App\Http\Controllers\masyarakat\CnowledgeController::class, 'post'])->name('cnowledge.post');
    Route::get('/load-more', [App\Http\Controllers\masyarakat\CnowledgeController::class, 'loadMore']);
    Route::get('/generate-pdf/{slug}', [App\Http\Controllers\masyarakat\CnowledgeController::class, 'generatePDF'])->name('cnowledge.pdf');
});

//Auth
Route::get('/login', [App\Http\Controllers\auth\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\auth\LoginController::class, 'authenticate']);
Route::post('/logout',[App\Http\Controllers\auth\LoginController::class, 'logout']);
Route::get('/register', [App\Http\Controllers\auth\RegisterController::class, 'index'])->name('register');
Route::post('/register', [App\Http\Controllers\auth\RegisterController::class, 'register']);

//Petani
Route::prefix('petani')->group(function () {
    Route::get('/', [App\Http\Controllers\petani\HomeController::class, 'home'])->name('petani.home')->middleware('petani');

    Route::get('/produk', [App\Http\Controllers\petani\ProdukController::class, 'produk'])->middleware('petani')->name('produk.produk');
    Route::post('/produk/add', [App\Http\Controllers\petani\ProdukController::class, 'add'])->middleware('petani')->name('produk.add');
    Route::put('/produk/edit/{id}', [App\Http\Controllers\petani\ProdukController::class, 'edit'])->middleware('petani')->name('produk.edit');

    Route::put('/notifications/accept/{id}', [App\Http\Controllers\petani\NotificationController::class, 'accept'])->middleware('petani')->name('notif.accept');
    Route::put('/notifications/decline/{id}', [App\Http\Controllers\petani\NotificationController::class, 'decline'])->middleware('petani')->name('notif.decline');
    Route::put('/notifications/edit/{id}', [App\Http\Controllers\petani\NotificationController::class, 'edit'])->middleware('petani')->name('notif.edit');

    Route::get('/transaksi', [App\Http\Controllers\petani\TransaksiController::class, 'transaksi'])->middleware('petani')->name('transaksi.transaksi');
    Route::post('/transaksi/add/{id}', [App\Http\Controllers\petani\TransaksiController::class, 'add'])->middleware('petani')->name('transaksi.add');
    Route::get('/transaksi/export', [App\Http\Controllers\petani\TransaksiController::class, 'export'])->middleware('petani')->name('transaksi.export');
    Route::post('/transaksi/import', [App\Http\Controllers\petani\TransaksiController::class, 'import'])->middleware('petani')->name('transaksi.import');

    Route::get('/akun/profil', [App\Http\Controllers\petani\ProfileController::class, 'profile'])->middleware('petani')->name('petani.profile');
    Route::put('/akun/profil/{id}', [App\Http\Controllers\petani\ProfileController::class, 'edit'])->middleware('petani')->name('petani.edit');
    Route::put('/akun/profil/{id}/change-password', [App\Http\Controllers\petani\ProfileController::class, 'changePassword'])->middleware('petani')->name('petani.change-password');

    Route::get('/akun/toko', [App\Http\Controllers\petani\TokoController::class, 'toko'])->middleware('petani')->name('toko.toko');
    Route::put('/akun/toko/{id}', [App\Http\Controllers\petani\TokoController::class, 'edit'])->middleware('petani')->name('toko.edit');
});

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard')->middleware('admin');

    Route::get('/slider', [App\Http\Controllers\admin\SliderController::class, 'show'])->middleware('admin')->name('slider.slider');
    Route::get('/slider/add', [App\Http\Controllers\admin\SliderAddController::class, 'show'])->middleware('admin')->name('slider.show');
    Route::post('/slider/add', [App\Http\Controllers\admin\SliderAddController::class, 'store'])->middleware('admin')->name('slider.store');
    Route::get('/slider/edit/{id}', [App\Http\Controllers\admin\SliderEditController::class, 'show'])->middleware('admin')->name('slider.edit');
    Route::put('/slider/edit/{id}', [App\Http\Controllers\admin\SliderEditController::class, 'update'])->middleware('admin')->name('slider.update');
    Route::delete('/slider/delete/{id}', [App\Http\Controllers\admin\SliderController::class, 'delete'])->middleware('admin')->name('slider.delete');

    Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'show'])->middleware('admin');
    Route::put('/profile/{id}', [App\Http\Controllers\admin\ProfileController::class, 'edit'])->middleware('admin')->name('profil.edit');
    Route::put('/profil/{id}/change-password', [App\Http\Controllers\admin\ProfileController::class, 'changePassword'])->name('profil.change-password');
    Route::get('/notification', [App\Http\Controllers\admin\NotificationController::class, 'show'])->middleware('admin');

    Route::get('/akun/petani', [App\Http\Controllers\admin\AccountController::class, 'petani'])->middleware('admin')->name('petani.account');
    //delete admin dan petani routenya sama
    Route::delete('/akun/petani/{id}', [App\Http\Controllers\admin\AccountController::class, 'delete'])->middleware('admin')->name('account.delete');

    Route::get('/akun/admin', [App\Http\Controllers\admin\AccountController::class, 'admin'])->middleware('admin')->name('admin.account');;
    Route::get('/akun/admin/add', [App\Http\Controllers\admin\AccountController::class, 'addAdmin'])->middleware('admin');
    Route::post('/akun/admin/add', [App\Http\Controllers\admin\AccountController::class, 'store'])->middleware('admin')->name('admin.store');

    Route::get('/distribusi', [App\Http\Controllers\admin\DistribusiController::class, 'show'])->middleware('admin')->name('distribusi.distribusi');
    Route::post('/distribusi/tawarkanPromosi/{id}', [App\Http\Controllers\admin\DistribusiController::class, 'promosi'])->middleware('admin')->name('promosi.add');

    Route::get('/faq', [App\Http\Controllers\admin\FaqController::class, 'show'])->middleware('admin')->name('faq.faq');
    Route::delete('/faq/delete/{id}', [App\Http\Controllers\admin\FaqController::class, 'delete'])->middleware('admin')->name('faq.delete');
    Route::get('/faq/edit/{id}', [App\Http\Controllers\admin\FaqEditController::class, 'show'])->middleware('admin');
    Route::put('/faq/edit/{id}', [App\Http\Controllers\admin\FaqEditController::class, 'update'])->middleware('admin')->name('faq.update');

    Route::get('/faq/kategori', [App\Http\Controllers\admin\KategoriController::class, 'show'])->middleware('admin')->name('kategori.kategori');
    Route::post('/faq/kategori/add', [App\Http\Controllers\admin\KategoriController::class, 'add'])->middleware('admin')->name('kategori.add');
    Route::put('/faq/kategori/edit/{id}', [App\Http\Controllers\admin\KategoriController::class, 'edit'])->middleware('admin')->name('kategori.edit');
    Route::delete('/faq/kategori/delete/{id}', [App\Http\Controllers\admin\KategoriController::class, 'delete'])->middleware('admin')->name('kategori.delete');

    Route::get('/cnowledge', [App\Http\Controllers\admin\CnowledgeController::class, 'show'])->middleware('admin')->name('cnowledge.cnowledge');
    Route::delete('/cnowledge/delete/{id}', [App\Http\Controllers\admin\CnowledgeController::class, 'delete'])->middleware('admin')->name('cnowledge.delete');
    Route::get('/cnowledge/add', [App\Http\Controllers\admin\CnowledgeAddController::class, 'show'])->middleware('admin');
    Route::post('/cnowledge/add', [App\Http\Controllers\admin\CnowledgeAddController::class, 'add'])->middleware('admin')->name('cnowledge.add');
    Route::get('/cnowledge/edit/{article:slug}', [App\Http\Controllers\admin\CnowledgeEditController::class, 'show'])->middleware('admin');
    Route::put('/cnowledge/edit/{article:slug}', [App\Http\Controllers\admin\CnowledgeEditController::class, 'edit'])->middleware('admin')->name('cnowledge.edit');
    Route::get('/cnowledge/detail/{article:slug}', [App\Http\Controllers\admin\CnowledgeDetailController::class, 'show'])->middleware('admin');

    Route::get('/cnowledge/kategori', [App\Http\Controllers\admin\CategoryController::class, 'show'])->middleware('admin')->name('class.kategori');
    Route::post('/cnowledge/kategori/add', [App\Http\Controllers\admin\CategoryController::class, 'add'])->middleware('admin')->name('class.add');
    Route::put('/cnowledge/kategori/edit/{id}', [App\Http\Controllers\admin\CategoryController::class, 'edit'])->middleware('admin')->name('class.edit');
    Route::delete('/cnowledge/kategori/delete/{id}', [App\Http\Controllers\admin\CategoryController::class, 'delete'])->middleware('admin')->name('class.delete');

});
