<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\NewsletterController;

/*
|--------------------------------------------------------------------------
| EVA Autisme - Routes principales
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// À Propos
Route::prefix('a-propos')->name('about.')->group(function () {
    Route::get('/qui-sommes-nous',  [AboutController::class, 'quiSommesNous'])->name('qui-sommes-nous');
    Route::get('/notre-histoire',   [AboutController::class, 'histoire'])->name('histoire');
    Route::get('/notre-impact',     [AboutController::class, 'impact'])->name('impact');
    Route::get('/notre-demarche',   [AboutController::class, 'demarche'])->name('demarche');
    Route::get('/faq',              [AboutController::class, 'faq'])->name('faq');
});

// Nos Actions
Route::prefix('nos-actions')->name('actions.')->group(function () {
    Route::get('/nos-projets',          [ActionsController::class, 'projets'])->name('projets');
    Route::get('/nos-realisations',     [ActionsController::class, 'realisations'])->name('realisations');
    Route::get('/formation',            [ActionsController::class, 'formation'])->name('formation');
    Route::post('/formation/inscription',[ActionsController::class, 'registerFormation'])->name('formation.register');
    Route::get('/evenements',           [ActionsController::class, 'evenements'])->name('evenements');
    Route::post('/evenements/{id}/inscription', [ActionsController::class, 'registerEvent'])->name('evenements.register');
    Route::get('/club-parents',         [ActionsController::class, 'clubParents'])->name('club-parents');
    Route::post('/club-parents/adhesion',[ActionsController::class, 'joinClub'])->name('club-parents.join');
});

// Raccourcis pour les routes courtes utilisés dans les vues
Route::post('/formation/inscription',    [ActionsController::class, 'registerFormation'])->name('formation.register');
Route::post('/evenements/{id}/inscription',[ActionsController::class, 'registerEvent'])->name('event.register');
Route::post('/club-parents/adhesion',    [ActionsController::class, 'joinClub'])->name('club-parents.join');

// Nos Ressources
Route::prefix('nos-ressources')->name('resources.')->group(function () {
    Route::get('/publications', [ResourcesController::class, 'publications'])->name('publications');
    Route::get('/medias',       [ResourcesController::class, 'medias'])->name('medias');
});

// Contact
Route::get('/contactez-nous',    [ContactController::class, 'index'])->name('contact');
Route::post('/contactez-nous',   [ContactController::class, 'send'])->name('contact.send');

// Don
Route::get('/faire-un-don',      [DonController::class, 'index'])->name('don');
Route::post('/faire-un-don',     [DonController::class, 'process'])->name('don.process');

// Newsletter
Route::post('/newsletter/inscription', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Pages légales
Route::view('/mentions-legales',             'pages.mentions-legales')->name('mentions-legales');
Route::view('/politique-de-confidentialite', 'pages.politique-confidentialite')->name('politique-confidentialite');
