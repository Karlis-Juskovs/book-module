<?php

use Illuminate\Support\Facades\Route;
use Karlis\Module2\Http\Controllers\AuthorController;
use Karlis\Module2\Http\Controllers\BookController;

Route::prefix('authors')->group(function () {
    Route::get('', [AuthorController::class, 'index'])->name('author.index');
    Route::post('', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/{id}', [AuthorController::class, 'show'])->name('author.show');
    Route::put('/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
});

Route::prefix('books')->group(function () {
    Route::get('', [BookController::class, 'index'])->name('book.index');
    Route::post('', [BookController::class, 'store'])->name('book.store');
    Route::get('/{id}', [BookController::class, 'show'])->name('book.show');
    Route::put('/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('book.destroy');
});
