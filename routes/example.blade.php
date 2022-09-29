Route::get('/devolucions/{id}', [DevolucionController::class, 'index'])->name('devolucions');
Route::get('/devolucion/create/{id}', [DevolucionController::class, 'create'])->name('devolucion.create');
Route::post('/devolucion/store', [DevolucionController::class, 'store'])->name('devolucion.store');
Route::get('/devolucion/edit/{id}', [DevolucionController::class, 'edit'])->name('devolucion.edit');
Route::post('/devolucion/update/{id}', [DevolucionController::class, 'update'])->name('devolucion.update');
Route::delete('/devolucion/delete/{id}', [DevolucionController::class, 'destroy'])->name('devolucion.delete');
Route::get('/devolucion/show/{id}', [DevolucionController::class, 'show'])->name('devolucion.show');