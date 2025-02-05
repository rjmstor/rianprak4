<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(AdminController::class)->group(function (){
    Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home')
                                                                ->middleware('is_admin');
    Route::get('admin/books', 'books')->name('admin.books')
                                        ->middleware('is_admin');
    Route::post('admin/books', 'submit_book')->name('admin.book.submit')
                                                ->middleware('is_admin');
    Route::patch('admin/books/update', 'update_book')->name('admin.book.update')
                                                ->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataBuku/{id}', 'getDataBuku');
    Route::delete('admin/books/delete/{id}', 'delete_book')->name('admin.book.delete')
                                                ->middleware('is_admin'); 
    Route::get('admin/print_books', 'print_books')->name('admin.print.books')
                                                ->middleware('is_admin');
    Route::get('admin/books/export', 'export')->name('admin.book.export')
                                            ->middleware('is_admin');
    Route::post('admin/books/import', 'import')->name('admin.book.import')
                                            ->middleware('is_admin');
    Route::get('admin/trash', 'trash')->name('trash')
                                    ->middleware('is_admin');
    Route::delete('admin/books/empty/{id}', 'delete_force')->name('admin.book.delete.force')
                                    ->middleware('is_admin');
    Route::post('admin/books/restore/{id}', 'restore')->name('admin.book.delete.force')
                                    ->middleware('is_admin');
    Route::post('admin/restore/all', 'restoreAll')->name('admin.book.restore')
                                    ->middleware('is_admin');
    Route::post('admin/delete/all', 'deleteAll')->name('admin.book.deleteAll')
                                    ->middleware('is_admin'); 
 
});

                                                                