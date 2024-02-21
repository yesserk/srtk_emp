<?php

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

Route::get('/voyage_emp', 'App\Http\Controllers\Voyage_emp@index');
Route::get('/list_voyage', 'App\Http\Controllers\Voyage_emp@list_voyage');

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/filtrerParDate', [App\Http\Controllers\HomeController::class, 'filtrerParDate'])->name('filtre')->middleware('auth');


//--------------------------------------USERS-------------------------------------------------------
Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users')->middleware('auth');
Route::get('/users/form', 'App\Http\Controllers\UserController@add')->name('users.create')->middleware('auth');
Route::post('/users/form', 'App\Http\Controllers\UserController@store')->name('users.store')->middleware('auth');
Route::delete('/admin/delete-user/{id}', 'App\Http\Controllers\UserController@deleteUser')->name('users.delete')->middleware('auth');
Route::get('/admin/edit_user/{id}', 'App\Http\Controllers\UserController@editUser')->name('users.edit')->middleware('auth');
Route::put('/admin/edit_user/{id}', 'App\Http\Controllers\UserController@updateUser')->name('users.update')->middleware('auth');

//permission
Route::get('/users/permissions/{id}', 'App\Http\Controllers\UserController@addPermission')->name('users.permission');
Route::post('/users/permissions/{id}', 'App\Http\Controllers\UserController@storePermission')->name('users.store.permission');


//--------------------------------------EMPLOYES-------------------------------------------------------
Route::get('/employees', 'App\Http\Controllers\EmployeeController@index')->name('employees')->middleware('auth');
Route::get('/employees/create', 'App\Http\Controllers\EmployeeController@create')->name('employees.create')->middleware('auth');
Route::post('/employees', 'App\Http\Controllers\EmployeeController@store')->name('employees.store')->middleware('auth');
Route::get('/employees/{id}/edit', 'App\Http\Controllers\EmployeeController@edit')->name('employees.edit')->middleware('auth');
Route::put('/employees/{id}', 'App\Http\Controllers\EmployeeController@update')->name('employees.update')->middleware('auth');
Route::delete('/employees/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('employees.destroy')->middleware('auth');
Route::get('/employees/search', 'App\Http\Controllers\EmployeeController@search_employee')->name('employees.search_employee')->middleware('auth');


//--------------------------------------TYPE EMPLOYES-------------------------------------------------------

Route::get('/type-employees', 'App\Http\Controllers\TypeEmployeeController@index')->name('type_employees')->middleware('auth');
Route::get('/type-employees/create', 'App\Http\Controllers\TypeEmployeeController@create')->name('type_employees.create')->middleware('auth');
Route::post('/type-employees', 'App\Http\Controllers\TypeEmployeeController@store')->name('type_employees.store')->middleware('auth');
Route::get('/type-employees/{id}/edit', 'App\Http\Controllers\TypeEmployeeController@edit')->name('type_employees.edit')->middleware('auth');
Route::put('/type-employees/{id}', 'App\Http\Controllers\TypeEmployeeController@update')->name('type_employees.update')->middleware('auth');
Route::delete('/type-employees/{id}', 'App\Http\Controllers\TypeEmployeeController@destroy')->name('type_employees.destroy')->middleware('auth');
Route::get('/type-employees/search', 'App\Http\Controllers\TypeEmployeeController@search_type_employee')->name('type_employees.search_type_employee')->middleware('auth');


//--------------------------------------ETAT EMPLOYES-------------------------------------------------------

Route::get('/etat-employees', 'App\Http\Controllers\EtatEmployeeController@index')->name('etat_employees')->middleware('auth');
Route::get('/etat-employees/create', 'App\Http\Controllers\EtatEmployeeController@create')->name('etat_employees.create')->middleware('auth');
Route::post('/etat-employees', 'App\Http\Controllers\EtatEmployeeController@store')->name('etat_employees.store')->middleware('auth');
Route::get('/etat-employees/{id}/edit', 'App\Http\Controllers\EtatEmployeeController@edit')->name('etat_employees.edit')->middleware('auth');
Route::put('/etat-employees/{id}', 'App\Http\Controllers\EtatEmployeeController@update')->name('etat_employees.update')->middleware('auth');
Route::delete('/etat-employees/{id}', 'App\Http\Controllers\EtatEmployeeController@destroy')->name('etat_employees.destroy')->middleware('auth');
Route::get('/etat-employees/search', 'App\Http\Controllers\EtatEmployeeController@search_etat_employee')->name('etat_employees.search_etat_employee')->middleware('auth');


//------------------------------------- ETAT-------------------------------------------------------

Route::get('/etat', 'App\Http\Controllers\EtatController@index')->name('etat')->middleware('auth');
Route::get('/etat/create', 'App\Http\Controllers\EtatController@create')->name('etat.create')->middleware('auth');
Route::post('/etat', 'App\Http\Controllers\EtatController@store')->name('etat.store')->middleware('auth');
Route::get('/etat/{id}/edit', 'App\Http\Controllers\EtatController@edit')->name('etat.edit')->middleware('auth');
Route::put('/etat/{id}', 'App\Http\Controllers\EtatController@update')->name('etat.update')->middleware('auth');
Route::delete('/etat/{id}', 'App\Http\Controllers\EtatController@destroy')->name('etat.destroy')->middleware('auth');
Route::get('/etat/search', 'App\Http\Controllers\EtatController@search_etat')->name('etat.search_etat')->middleware('auth');



//--------------------------------------BUS-------------------------------------------------------

Route::get('/bus', 'App\Http\Controllers\BusController@index')->name('bus')->middleware('auth');
Route::get('/bus/create', 'App\Http\Controllers\BusController@create')->name('bus.create')->middleware('auth');
Route::post('/bus', 'App\Http\Controllers\BusController@store')->name('bus.store')->middleware('auth');
Route::get('/bus/{code_car}/edit', 'App\Http\Controllers\BusController@edit')->name('bus.edit');
Route::put('/bus/{code_car}', 'App\Http\Controllers\BusController@update')->name('bus.update');

Route::delete('/bus/{id}', 'App\Http\Controllers\BusController@destroy')->name('bus.destroy')->middleware('auth');
Route::get('/bus/search', 'App\Http\Controllers\BusController@search_bus')->name('bus.search_bus')->middleware('auth');

//--------------------------------------LIGNE-------------------------------------------------------

Route::get('/ligne', 'App\Http\Controllers\LigneController@index')->name('ligne')->middleware('auth');
Route::get('/ligne/create', 'App\Http\Controllers\LigneController@create')->name('ligne.create')->middleware('auth');
Route::post('/ligne', 'App\Http\Controllers\LigneController@store')->name('ligne.store')->middleware('auth');
Route::get('/ligne/{id}/edit', 'App\Http\Controllers\LigneController@edit')->name('ligne.edit')->middleware('auth');
Route::put('/ligne/{id}', 'App\Http\Controllers\LigneController@update')->name('ligne.update')->middleware('auth');
Route::delete('/ligne/{id}', 'App\Http\Controllers\LigneController@destroy')->name('ligne.destroy')->middleware('auth');
Route::get('/ligne/station_ligne/{id}', 'App\Http\Controllers\LigneController@ligne_station')->name('ligne.stations')->middleware('auth');
Route::post('/ligne/addStation/{ligne}', 'App\Http\Controllers\LigneController@addStation')->name('ligne.addStation')->middleware('auth');
Route::get('/ligne/station/{id}/{id_station}', 'App\Http\Controllers\LigneController@destroy_ligne_station')->name('ligne.stations.destroy')->middleware('auth');
Route::get('/ligne/search', 'App\Http\Controllers\LigneController@search_ligne')->name('ligne.search_ligne')->middleware('auth');


//--------------------------------------STATION-------------------------------------------------------

Route::get('/station', 'App\Http\Controllers\StationController@index')->name('station')->middleware('auth');
Route::get('/station/create', 'App\Http\Controllers\StationController@create')->name('station.create')->middleware('auth');
Route::post('/station', 'App\Http\Controllers\StationController@store')->name('station.store')->middleware('auth');
Route::get('/station/{id}/edit', 'App\Http\Controllers\StationController@edit')->name('station.edit')->middleware('auth');
Route::put('/station/{id}', 'App\Http\Controllers\StationController@update')->name('station.update')->middleware('auth');
Route::delete('/station/{id}', 'App\Http\Controllers\StationController@destroy')->name('station.destroy')->middleware('auth');
Route::get('/station/search', 'App\Http\Controllers\StationController@search_station')->name('stations.search_station')->middleware('auth');


//--------------------------------------Ticket-------------------------------------------------------

Route::get('/ticket', 'App\Http\Controllers\TicketController@index')->name('ticket')->middleware('auth');
Route::get('/ticket/create', 'App\Http\Controllers\TicketController@create')->name('ticket.create')->middleware('auth');
Route::post('/ticket', 'App\Http\Controllers\TicketController@store')->name('ticket.store')->middleware('auth');
Route::get('/ticket/{id}/edit', 'App\Http\Controllers\TicketController@edit')->name('ticket.edit')->middleware('auth');
Route::put('/ticket/{id}', 'App\Http\Controllers\TicketController@update')->name('ticket.update')->middleware('auth');
Route::delete('/ticket/{id}', 'App\Http\Controllers\TicketController@destroy')->name('ticket.destroy')->middleware('auth');
Route::get('/ticket/search', 'App\Http\Controllers\TicketController@search_ticket')->name('tickets.search_ticket')->middleware('auth');

//--------------------------------------VOYAGE-------------------------------------------------------

Route::get('/voyage', 'App\Http\Controllers\VoyageController@index')->name('voyage')->middleware('auth');
Route::get('/voyage/create', 'App\Http\Controllers\VoyageController@create')->name('voyage.create')->middleware('auth');
Route::post('/voyage', 'App\Http\Controllers\VoyageController@store')->name('voyage.store')->middleware('auth');
Route::get('/voyage/{id}/edit', 'App\Http\Controllers\VoyageController@edit')->name('voyage.edit')->middleware('auth');
Route::put('/voyage/{id}', 'App\Http\Controllers\VoyageController@update')->name('voyage.update')->middleware('auth');
Route::delete('/voyage/{id}', 'App\Http\Controllers\VoyageController@destroy')->name('voyage.destroy')->middleware('auth');
Route::get('/voyage/download/{id}', 'App\Http\Controllers\VoyageController@download')->name('voyage.download')->middleware('auth');


//--------------------------------------Gare-------------------------------------------------------

Route::get('/gare', 'App\Http\Controllers\GareController@index')->name('gare')->middleware('auth');
Route::get('/gare/create', 'App\Http\Controllers\GareController@create')->name('gare.create')->middleware('auth');
Route::post('/gare', 'App\Http\Controllers\GareController@store')->name('gare.store')->middleware('auth');
Route::get('/gare/{id}/edit', 'App\Http\Controllers\GareController@edit')->name('gare.edit')->middleware('auth');
Route::put('/gare/{id}', 'App\Http\Controllers\GareController@update')->name('gare.update')->middleware('auth');
Route::delete('/gare/{id}', 'App\Http\Controllers\GareController@destroy')->name('gare.destroy')->middleware('auth');
Route::get('/gare/search', 'App\Http\Controllers\GareController@search_gare')->name('gare.search_gare')->middleware('auth');

//--------------------------------------CAISSE-------------------------------------------------------

Route::get('/caisse/{voyage_id}', 'App\Http\Controllers\CaisseController@index')->name('caisse.index')->middleware('auth');
Route::get('/caisse/create/{voyage_id}', 'App\Http\Controllers\CaisseController@create')->name('caisse.create')->middleware('auth');
Route::post('/caisse', 'App\Http\Controllers\CaisseController@store')->name('caisse.store')->middleware('auth');
Route::get('/caisse/{idC}/edit', 'App\Http\Controllers\CaisseController@edit')->name('caisse.edit');
Route::put('/caisse/update/{id}', 'App\Http\Controllers\CaisseController@update')->name('caisse.update');
Route::delete('/caisse/{idC}', 'App\Http\Controllers\CaisseController@destroy')->name('caisse.destroy')->middleware('auth');


//--------------------------------------VOYAGEUR-------------------------------------------------------

Route::get('/voyageur/{voyage_id}', 'App\Http\Controllers\VoyageurController@index')->name('voyageur.index')->middleware('auth');
Route::get('/voyageur/create/{voyage_id}', 'App\Http\Controllers\VoyageurController@create')->name('voyageur.create')->middleware('auth');
Route::post('/voyageur/store_chang', 'App\Http\Controllers\VoyageurController@store_chang')->name('voyageur.store_chang')->middleware('auth');
Route::post('/voyageur/store_stan', 'App\Http\Controllers\VoyageurController@store_stan')->name('voyageur.store_stan')->middleware('auth');

Route::get('/voyageur/{idC}/edit/stand', 'App\Http\Controllers\VoyageurController@edit_stand')->name('voyageur.edit_stan')->middleware('auth');
Route::put('/voyageur/{id}', 'App\Http\Controllers\VoyageurController@update_stand')->name('voyageur_update.update_stand')->middleware('auth');


Route::get('/voyageur/{idC}/edit/chang', 'App\Http\Controllers\VoyageurController@edit_chang')->name('voyageur.edit_chang')->middleware('auth');
Route::put('/voyageur/{id}', 'App\Http\Controllers\VoyageurController@update_chang')->name('voyageur.update_chang')->middleware('auth');



Route::delete('/voyageur/{idC}', 'App\Http\Controllers\VoyageurController@destroy')->name('voyageur.destroy')->middleware('auth');

//--------------------------------------RESERVATION-------------------------------------------------------

Route::get('/reservation', 'App\Http\Controllers\ReservationController@index')->name('reservation')->middleware('auth');
Route::get('/reservation/create', 'App\Http\Controllers\ReservationController@create')->name('reservation.create')->middleware('auth');
Route::post('/reservation', 'App\Http\Controllers\ReservationController@store')->name('reservation.store')->middleware('auth');
Route::get('/reservation/{id}/edit', 'App\Http\Controllers\ReservationController@edit')->name('reservation.edit')->middleware('auth');
Route::put('/reservation/{id}', 'App\Http\Controllers\ReservationController@update')->name('reservation.update')->middleware('auth');
Route::delete('/reservation/{id}', 'App\Http\Controllers\ReservationController@destroy')->name('reservation.destroy')->middleware('auth');
Route::get('/reservation/search', 'App\Http\Controllers\ReservationController@search_reservation')->name('reservation.search_reservation')->middleware('auth');


Route::get('/resume', 'App\Http\Controllers\ResumeController@index')->name('resume')->middleware('auth');

Route::get('/resume/download', 'App\Http\Controllers\ResumeController@generatePDF')->name('resume.download')->middleware('auth');


