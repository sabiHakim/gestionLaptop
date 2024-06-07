<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $admin =\App\Models\Login::all();
    return view('Login.login',compact('admin'));
});
Route::get('/profilpv', function () {
    $pv = \Illuminate\Support\Facades\DB::select("select  * from pv");
    return view('Login.Profilpv',compact('pv'));
});
Route::post('traitLogin',[\App\Http\Controllers\LoginController::class,'traitLogin'])->name('traitLogin');
Route::get( 'traitLoginpv', [\App\Http\Controllers\LoginController::class,'traitLoginpv'])->name('traitLoginpv');
Route::get('acceuil',[\App\Http\Controllers\LoginController::class,'acceuil']);
Route::middleware('securityAdmin')->group(function (){
    Route::get('pageAddLaptop',[\App\Http\Controllers\laptop::class,'pageAddLaptop']);
    Route::get('traitlap',[\App\Http\Controllers\laptop::class,'traitlap']);
    Route::get('modifLap/{id}',[\App\Http\Controllers\laptop::class,'modifLap']);
    Route::get('traitmodiflap',[\App\Http\Controllers\laptop::class,'traitmodiflap']);
    Route::get('deletelap',[\App\Http\Controllers\laptop::class,'deletelap']);
//    marques
    Route::get('marque',[\App\Http\Controllers\laptop::class,'marque']);
    Route::get('modifm/{id}',[\App\Http\Controllers\laptop::class,'modifm']);
    Route::get('traitmodifm',[\App\Http\Controllers\laptop::class,'traitmodifm']);
    Route::get('deletem',[\App\Http\Controllers\laptop::class,'deletem']);
    Route::get('pageAddm',[\App\Http\Controllers\laptop::class,'pageAddm']);
    Route::get('traitm',[\App\Http\Controllers\laptop::class,'traitm']);
//processeur
    Route::get('proc',[\App\Http\Controllers\laptop::class,'proc']);
    Route::get('modifp/{id}',[\App\Http\Controllers\laptop::class,'modifp']);
    Route::get('traitmodifp',[\App\Http\Controllers\laptop::class,'traitmodifp']);
    Route::get('deletep',[\App\Http\Controllers\laptop::class,'deletep']);
    Route::get('pageAddp',[\App\Http\Controllers\laptop::class,'pageAddp']);
    Route::get('traitp',[\App\Http\Controllers\laptop::class,'traitp']);
//    pv
    Route::get('pv',[\App\Http\Controllers\laptop::class,'pv']);
    Route::get('pageAddpv',[\App\Http\Controllers\laptop::class,'pageAddpv']);
    Route::get('traitpv',[\App\Http\Controllers\laptop::class,'traitpv']);
    Route::get('traitpvmap',[\App\Http\Controllers\laptop::class,'traitpvmap']);
    Route::get('deletepv',[\App\Http\Controllers\laptop::class,'deletepv']);
    Route::get('modifpv/{id}',[\App\Http\Controllers\laptop::class,'modifpv']);
    Route::get('traitmodifpv',[\App\Http\Controllers\laptop::class,'traitmodifpv']);
    Route::get('detailpv/{id}',[\App\Http\Controllers\GestionUser::class,'detailpv']);
//gestion user
    Route::get('traitT',[\App\Http\Controllers\GestionUser::class,'traitT']);
//    achat Lap
    Route::get('achatLaptop',[\App\Http\Controllers\laptop::class,'achatLaptop']);
    Route::get('traitAchat',[\App\Http\Controllers\laptop::class,'traitAchat']);
    Route::get('TransfertLaptop',[\App\Http\Controllers\laptop::class,'TransfertLaptop']);
    Route::get('traitTransfertLap',[\App\Http\Controllers\laptop::class,'traitTransfertLap']);
//    stat
    Route::get('Stat',[\App\Http\Controllers\laptop::class,'Stat']);
    Route::get('traitstat',[\App\Http\Controllers\laptop::class,'traitstat']);
    Route::get('histo/{annee}',[\App\Http\Controllers\laptop::class,'histo']);
    Route::get('export',[\App\Http\Controllers\laptop::class,'export']);
    Route::get('benefice',[\App\Http\Controllers\laptop::class,'benefice']);
});
//pv
Route::middleware('securitypv')->group(function (){
    Route::post('validationRecus',[\App\Http\Controllers\laptop::class,'validationRecus']);
    Route::get('renvoi',[\App\Http\Controllers\laptop::class,'renvoi']);
    Route::get('ventes',[\App\Http\Controllers\laptop::class,'ventes']);
    Route::get('traitventes',[\App\Http\Controllers\laptop::class,'traitventes']);
    Route::get('StatVentesPv',[\App\Http\Controllers\laptop::class,'StatVentesPv']);
    Route::get('traitstatpv',[\App\Http\Controllers\laptop::class,'traitstatpv']);



});
Route::get('logout',[\App\Http\Controllers\LoginController::class,'logout']);
