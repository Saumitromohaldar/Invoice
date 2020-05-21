<?php

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

// Route::get('/', function () {
//     return view('backend.home');
// });
//use Symfony\Component\Routing\Route;
Auth::routes();

Route::group(['middleware' => ['admin','auth']], function () {

    /**
     * USER
     */
    Route::get('users', 'UserController@index')->name('users.index');    
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::POST('users', 'UserController@store')->name('users.store');
    Route::GET('users/{user}', 'UserController@show')->name('users.show');
    Route::GET('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::PUT('users/{user}', 'UserController@update')->name('users.update');
    Route::get('delete/users/{user}', 'UserController@destroy')->name('users.destroy');

    Route::get('delete/company/{company_id}', 'CompanyController@deleteCompany')->name('delete-company');
    Route::get('delete/invoice/{invoice_id}', 'InvoiceController@deleteInvoice')->name('delete-invoice');


    Route::get('delete/document/{document_id}', 'DocumentsController@deleteDocument')->name('delete-document');
    Route::get('delete/folder/{id}', 'DocumentsController@deleteFolder')->name('delete-folder');
    Route::get('delete/file/{id}', 'DocumentsController@deleteFile')->name('delete-file');

   


});
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    /**
     * Company
     */
    Route::get('companies', 'CompanyController@allCompanies')->name('companies');
    Route::get('company/{company_id}/{folder_id?}', 'CompanyController@Company')->name('company');
    Route::get('add/company', 'CompanyController@CreateCompany')->name('create-company');
    Route::POST('save/company', 'CompanyController@store')->name('save-company');
    Route::get('edit/company/{company_id}', 'CompanyController@EditCompany')->name('edit-company');
    Route::POST('update/company/{company_id}', 'CompanyController@UpdateCompany')->name('update-company');
    
    /**
     * Invoice
     */
    Route::get('invoices', 'InvoiceController@allInvoices')->name('invoices');
    Route::get('invoice/{invoice_id}', 'InvoiceController@invoice')->name('invoice');
    Route::get('add/invoice/{company_id?}', 'InvoiceController@createInvoice')->name('create-invoice');
    Route::POST('save/invoice', 'InvoiceController@store')->name('save-invoice');
    Route::get('edit/invoice/{invoice_id}', 'InvoiceController@editInvoice')->name('edit-invoice');
   
    Route::POST('update/invoice/{invoice_id}', 'InvoiceController@updateInvoice')->name('update-invoice');

    Route::POST('get/company-data', 'CompanyController@getCompanyData')->name('get-company-data');


    Route::get('add/pdf-invoice/{invoice_id}', 'InvoiceController@createInvoicePdf')->name('create-pdf-invoice');

    Route::get('official-documents/{folder_id?}', 'DocumentsController@officialDocuments')->name('official-documents');

    Route::post('create/folder/{folder_id}/{company_id?}', 'DocumentsController@createFolder')->name('create-folder');

    Route::post('save/document/{folder_id}/{company_id?}', 'DocumentsController@saveDocument')->name('save-document');    

    Route::get('download/document/{document_id}', 'DocumentsController@downloadDocument')->name('download-document');    
    

    Route::POST('send/mail/{invoice_id}', 'MailController@sendMail')->name('send-mail');


    Route::GET('profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::PUT('profile/{user}', 'ProfileController@update')->name('profile.update');
    Route::POST('update/password/{user}', 'ProfileController@updatePassword')->name('password.update');
    
     /**
     * Category
     */
    Route::resource('categories', 'CategoryController');
    Route::resource('income_expenses', 'IncomeExpenseController');

});

