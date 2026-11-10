<?php

use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogueController::class, 'index'])->name('catalogue.index');
Route::post('/problems', [CatalogueController::class, 'storeProblem'])->name('problems.store');
Route::patch('/problems/{problem}', [CatalogueController::class, 'updateProblem'])->name('problems.update');
Route::delete('/problems/{problem}', [CatalogueController::class, 'destroyProblem'])->name('problems.destroy');
Route::post('/solutions', [CatalogueController::class, 'storeSolution'])->name('solutions.store');
Route::patch('/solutions/{solution}', [CatalogueController::class, 'updateSolution'])->name('solutions.update');
Route::delete('/solutions/{solution}', [CatalogueController::class, 'destroySolution'])->name('solutions.destroy');
Route::post('/offers', [CatalogueController::class, 'storeOffer'])->name('offers.store');
Route::patch('/offers/{offer}', [CatalogueController::class, 'updateOffer'])->name('offers.update');
Route::delete('/offers/{offer}', [CatalogueController::class, 'destroyOffer'])->name('offers.destroy');
