<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmploiController;
use App\Models\EmploiFiliere;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Models\Enseignant;

Route::get('/', function () {
   return view('admin.login_admin');
})->name('viewlogin.admin');

Route::post('/',[AdminController::class,'login'])->name('login.admin');

Route::get('/enseignant',function () {
   return view('enseignant.login_enseignant');
})->name('viewlogin.enseignant');

Route::post('/enseignant',[EnseignantController::class,'login'])->name('login.enseignant');
Route::get('/enseignant/dashboard',[EnseignantController::class,'Dashboard'])->name('Dashboard.enseignant');
Route::get('/enseignant/emploi', [EnseignantController::class, 'enseignantSeances'])->name('enseignant.emploi');
Route::patch('/enseignant/dashboad',[EnseignantController::class,'enseignantmdp'])->name('enseignant.mdp');


Route::get('/etudiant',function () {
   return view('etudiant.login_etudiant');
})->name('viewlogin.etudiant');

Route::post('/etudiant',[EtudiantController::class,'login'])->name('login.etudiant');
Route::get('/etudiant/dashboard',[EtudiantController::class,'Dashboard'])->name('Dashboard.etudiant');
Route::get('/etudiant/emploi', [EtudiantController::class, 'etudiantSeances'])->name('etudiant.emploi');
Route::patch('/etudiant/dashboard',[EtudiantController::class,'etudiantmdp'])->name('etudiant.mdp');




//Route::get('/admin',[AdminController::class , 'index'])->name('admin.index');
Route::get('/admin/Etudiants',[EtudiantController::class, 'allEtudiants'])->name('etudiant.show');
Route::post('/admin/Etudiants',[EtudiantController::class,'store'])->name('etudiant.store');
// Define the route for updating a student using PATCH
Route::patch('/admin/Etudiants/{id}', [EtudiantController::class, 'update'])->name('etudiant.update');
Route::delete('/admin/Etudiants/{id}',[EtudiantController::class,'destroy'])->name('etudiant.destroy');


Route::get('/admin/Enseignants',[EnseignantController::class, 'allEnseignants'])->name('enseignant.show');
Route::post('/admin/Enseignants',[EnseignantController::class,'store'])->name('enseignant.store');
Route::patch('/admin/Enseignants/{id}', [EnseignantController::class, 'update'])->name('enseignant.update');
Route::delete('/admin/Enseignants/{id}',[EnseignantController::class,'destroy'])->name('enseignant.destroy');


//Route::post('/emploi',[AdminController::class,'StoreSeance'])->name('seance.store');

Route::get('/emploi/idsit',[EmploiController::class,'idsit'])->name('seance.idsit');
Route::get('/emploi/gl',[EmploiController::class,'gl'])->name('seance.gl');
Route::get('/emploi/sse',[EmploiController::class,'sse'])->name('seance.sse');
Route::get('/emploi/ssi',[EmploiController::class,'ssi'])->name('seance.ssi');
Route::post('/emploi',[EmploiController::class,'store'])->name('seance.store');
Route::patch('/emploi/{id}',[EmploiController::class,'update'])->name('seance.update');
Route::delete('/emploi/{id}',[EmploiController::class,'destroy'])->name('seance.destroy');

