<?php

use App\Http\Middleware\EnsureCompanyExists;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\CompanyController@index')->name('company.index');
Route::get('/companies', function (){
    return redirect('/companies');
});
Route::get('/company','App\Http\Controllers\CompanyController@index' )->name('company.index');
Route::get('/company/new', 'App\Http\Controllers\CompanyController@create')->name('company.new');
Route::get('/company/edit/{id}', 'App\Http\Controllers\CompanyController@edit')->name('company.edit')->middleware(EnsureCompanyExists::class);
Route::post('/company/update/{id?}', 'App\Http\Controllers\CompanyController@store')->name('company.update')->middleware(VerifyCsrfToken::class);
Route::get('/company/details/{id}', 'App\Http\Controllers\CompanyController@show')->name('company.show')->middleware(EnsureCompanyExists::class);
Route::delete('/company/delete/{id}', 'App\Http\Controllers\CompanyController@destroy')->name('company.destroy')->middleware([VerifyCsrfToken::class, EnsureCompanyExists::class]);

