Route::get('/ventas', [VentaProductoController::class, 'index'])->name('ventas');
Route::get('/venta/create', [VentaProductoController::class, 'create'])->name('venta.create');
Route::post('/venta/store', [VentaProductoController::class, 'store'])->name('venta.store');
Route::get('/venta/procesar/{id}', [VentaProductoController::class, 'procesar'])->name('venta.procesar');
Route::get('/venta/edit/{id}', [VentaProductoController::class, 'edit'])->name('venta.edit');
Route::post('/venta/update/{id}', [VentaProductoController::class, 'update'])->name('venta.update');
Route::delete('/venta/delete/{id}', [VentaProductoController::class, 'destroy'])->name('venta.delete');
Route::get('/venta/show/{id}', [VentaProductoController::class, 'show'])->name('venta.show');