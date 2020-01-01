<?php
use Illuminate\Support\Facades\Auth;
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
    return redirect('/login');
});

Auth::routes(['reset' => false]);

Route::group(['name' => 'authenticated', 'middleware' => ['auth']], function(){
    
    Route::get('/home', function(){
        if(Auth::user()->role_id == 1){
            return redirect('/admin/home');
        }elseif(Auth::user()->role_id == 2){
            return redirect('/patient/home');
        }elseif(Auth::user()->role_id == 3){
            return redirect('/convenant/home');
        }elseif(Auth::user()->role_id == 4){
            return redirect('/doctor/home');
        }
    })->name('home');

    Route::get('/download_document/{document_id}', 'HomeController@download');

});

Route::group(['name' => 'admin', 'middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function(){

    Route::get('/home', 'Admin\HomeController@index')->name('Home');

    /**
     * CRUD operations for admins
     * -create 
     * -read
     * -update
     * -delete
     */
    Route::post('/add_admin', 'Admin\AdminsController@add')->name('Add admin');

    Route::get('/admins', 'Admin\AdminsController@index')->name('Admins');

    Route::post('/edit_admin/{admin_id}', 'Admin\AdminsController@edit')->name('Edit admin');

    /**
     * CRUD operations for patients
     * -create 
     * -read
     * -update
     * -delete
     */
    Route::post('/add_patient', 'Admin\PatientsController@add')->name('Add patient');

    Route::get('/patients', 'Admin\PatientsController@index')->name('Patients');

    Route::post('/edit_patient/{patient_id}', 'Admin\PatientsController@edit')->name('Edit patient');

    Route::get('/delete_patient/{patient_id}', 'Admin\PatientsController@delete')->name('Delete patient');

    /**
     * CRUD operations for convenants
     * -create 
     * -read
     * -update
     * -delete
     */
    Route::post('/add_convenant', 'Admin\ConvenantsController@add')->name('Add convenant');

    Route::get('/convenants', 'Admin\ConvenantsController@index')->name('Convenants');

    Route::post('/edit_convenant/{convenant_id}', 'Admin\ConvenantsController@edit')->name('Edit convenant');

    Route::get('/delete_convenant/{convenant_id}', 'Admin\ConvenantsController@delete')->name('Delete convenant');

    /**
     * CRUD operations for doctors
     * -create 
     * -read
     * -update
     * -delete
     */
    Route::post('/add_doctor', 'Admin\DoctorsController@add')->name('Add doctor');

    Route::get('/doctors', 'Admin\DoctorsController@index')->name('Doctors');

    Route::post('/edit_doctor/{doctor_id}', 'Admin\DoctorsController@edit')->name('Edit doctor');

    Route::get('/delete_doctor/{doctor_id}', 'Admin\DoctorsController@delete')->name('Delete doctor');

    /**
     * Operations for documents
     * -read
     * -delete
     */
    Route::get('/documents', 'Admin\DocumentsController@index')->name('Documents');

    Route::get('/delete_document/{document_id}', 'Admin\DocumentsController@delete')->name('Delete document');

    Route::get('/run_cron_job', 'Admin\HomeController@cronJob')->name('Run cron job');

});

Route::group(['name' => 'patient', 'middleware' => ['auth', 'isPatient'], 'prefix' => 'patient'], function(){

    Route::get('/home', 'Patient\HomeController@index')->name('Home');

});

Route::group(['name' => 'convenant', 'middleware' => ['auth', 'isConvenant'], 'prefix' => 'convenant'], function(){

    Route::get('/home', 'Convenant\HomeController@index')->name('Home');

});

Route::group(['name' => 'doctor', 'middleware' => ['auth', 'isDoctor'], 'prefix' => 'doctor'], function(){

    Route::get('/home', 'Doctor\HomeController@index')->name('Home');

});

Route::get('/document-search', function(){
    return view('document-search');
});

Route::post('/search-document', 'PublicController@searchDocument')->name('Search for document route');

Route::get('/add_to_your_account/{patient_protocol}/{patient_password}', 'PublicController@addToAcc')->name('Add files to your account')->middleware('auth');

Route::post('/zip_files', 'HomeController@zipFiles');