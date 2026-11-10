<?php

use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogueController::class, 'index'])->name('catalogue.index');
Route::post('/problems', [CatalogueController::class, 'storeProblem'])->name('problems.store');
Route::patch('/problems/{problem}', [CatalogueController::class, 'updateProblem'])->name('problems.update');
Route::delete('/problems/{problem}', [CatalogueController::class, 'destroyProblem'])->name('problems.destroy');
