Route::get('/inventarioofertas', [InventarioOfertaController::class, 'index'])->name('inventarioofertas');
Route::get('/inventariooferta/create', [InventarioOfertaController::class, 'create'])->name('inventariooferta.create');
Route::post('/inventariooferta/store', [InventarioOfertaController::class, 'store'])->name('inventariooferta.store');
Route::get('/inventariooferta/edit/{id}', [InventarioOfertaController::class, 'edit'])->name('inventariooferta.edit');
Route::post('/inventariooferta/update/{id}', [InventarioOfertaController::class, 'update'])->name('inventariooferta.update');
Route::delete('/inventariooferta/delete/{id}', [InventarioOfertaController::class, 'destroy'])->name('inventariooferta.delete');
Route::get('/inventariooferta/show/{id}', [InventarioOfertaController::class, 'show'])->name('inventariooferta.show');