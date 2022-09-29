<?php

use App\Http\Controllers\AdminDefaultController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleSalidaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\InventarioOfertaController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProductoBodegaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\SalidaProductoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\TipoSucursalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/seleccionar/{id}', [App\Http\Controllers\HomeController::class, 'seleccionar'])->name('home.seleccionar');

Route::get('/admindefault', [AdminDefaultController::class, 'default'])->name('admindefault');

Route::get('/roles', [RoleController::class, 'index'])->name('roles');
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
Route::get('/role/show/{id}', [RoleController::class, 'show'])->name('role.show');

Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados');
Route::get('/empleado/create', [EmpleadoController::class, 'create'])->name('empleado.create');
Route::post('/empleado/store', [EmpleadoController::class, 'store'])->name('empleado.store');
Route::get('/empleado/edit/{id}', [EmpleadoController::class, 'edit'])->name('empleado.edit');
Route::post('/empleado/update/{id}', [EmpleadoController::class, 'update'])->name('empleado.update');
Route::delete('/empleado/delete/{id}', [EmpleadoController::class, 'destroy'])->name('empleado.delete');
Route::get('/empleado/show/{id}', [EmpleadoController::class, 'show'])->name('empleado.show');

Route::get('/tiposucursals', [TipoSucursalController::class, 'index'])->name('tiposucursals');
Route::get('/tiposucursal/create', [TipoSucursalController::class, 'create'])->name('tiposucursal.create');
Route::post('/tiposucursal/store', [TipoSucursalController::class, 'store'])->name('tiposucursal.store');
Route::get('/tiposucursal/edit/{id}', [TipoSucursalController::class, 'edit'])->name('tiposucursal.edit');
Route::post('/tiposucursal/update/{id}', [TipoSucursalController::class, 'update'])->name('tiposucursal.update');
Route::delete('/tiposucursal/delete/{id}', [TipoSucursalController::class, 'destroy'])->name('tiposucursal.delete');
Route::get('/tiposucursal/show/{id}', [TipoSucursalController::class, 'show'])->name('tiposucursal.show');

Route::get('/sucursals', [SucursalController::class, 'index'])->name('sucursals');
Route::get('/sucursal/create', [SucursalController::class, 'create'])->name('sucursal.create');
Route::post('/sucursal/store', [SucursalController::class, 'store'])->name('sucursal.store');
Route::get('/sucursal/edit/{id}', [SucursalController::class, 'edit'])->name('sucursal.edit');
Route::post('/sucursal/update/{id}', [SucursalController::class, 'update'])->name('sucursal.update');
Route::delete('/sucursal/delete/{id}', [SucursalController::class, 'destroy'])->name('sucursal.delete');
Route::get('/sucursal/show/{id}', [SucursalController::class, 'show'])->name('sucursal.show');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::post('/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/delete/{id}', [ClienteController::class, 'destroy'])->name('cliente.delete');
Route::get('/cliente/show/{id}', [ClienteController::class, 'show'])->name('cliente.show');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');
Route::get('/categoria/create', [CategoriaController::class, 'create'])->name('categoria.create');
Route::post('/categoria/store', [CategoriaController::class, 'store'])->name('categoria.store');
Route::get('/categoria/edit/{id}', [CategoriaController::class, 'edit'])->name('categoria.edit');
Route::post('/categoria/update/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
Route::delete('/categoria/delete/{id}', [CategoriaController::class, 'destroy'])->name('categoria.delete');
Route::get('/categoria/show/{id}', [CategoriaController::class, 'show'])->name('categoria.show');

Route::get('/reclamos', [ReclamoController::class, 'index'])->name('reclamos');
Route::get('/reclamo/create', [ReclamoController::class, 'create'])->name('reclamo.create');
Route::post('/reclamo/store', [ReclamoController::class, 'store'])->name('reclamo.store');
Route::get('/reclamo/edit/{id}', [ReclamoController::class, 'edit'])->name('reclamo.edit');
Route::post('/reclamo/update/{id}', [ReclamoController::class, 'update'])->name('reclamo.update');
Route::delete('/reclamo/delete/{id}', [ReclamoController::class, 'destroy'])->name('reclamo.delete');
Route::get('/reclamo/show/{id}', [ReclamoController::class, 'show'])->name('reclamo.show');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos');
Route::get('/producto/create', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto/store', [ProductoController::class, 'store'])->name('producto.store');
Route::get('/producto/edit/{id}', [ProductoController::class, 'edit'])->name('producto.edit');
Route::post('/producto/update/{id}', [ProductoController::class, 'update'])->name('producto.update');
Route::delete('/producto/delete/{id}', [ProductoController::class, 'destroy'])->name('producto.delete');
Route::get('/producto/show/{id}', [ProductoController::class, 'show'])->name('producto.show');

Route::get('/salidas', [SalidaProductoController::class, 'index'])->name('salidas');
Route::get('/salida/create', [SalidaProductoController::class, 'create'])->name('salida.create');
Route::post('/salida/store', [SalidaProductoController::class, 'store'])->name('salida.store');
Route::get('/salida/procesar/{id}', [SalidaProductoController::class, 'procesar'])->name('salida.procesar');
Route::get('/salida/edit/{id}', [SalidaProductoController::class, 'edit'])->name('salida.edit');
Route::post('/salida/update/{id}', [SalidaProductoController::class, 'update'])->name('salida.update');
Route::delete('/salida/delete/{id}', [SalidaProductoController::class, 'destroy'])->name('salida.delete');
Route::get('/salida/show/{id}', [SalidaProductoController::class, 'show'])->name('salida.show');

Route::get('/detallesalidas/{id}', [DetalleSalidaController::class, 'index'])->name('detallesalidas');
Route::get('/detallesalida/create/{id}', [DetalleSalidaController::class, 'create'])->name('detallesalida.create');
Route::post('/detallesalida/store', [DetalleSalidaController::class, 'store'])->name('detallesalida.store');
Route::get('/detallesalida/edit/{id}', [DetalleSalidaController::class, 'edit'])->name('detallesalida.edit');
Route::post('/detallesalida/update/{id}', [DetalleSalidaController::class, 'update'])->name('detallesalida.update');
Route::delete('/detallesalida/delete/{id}', [DetalleSalidaController::class, 'destroy'])->name('detallesalida.delete');
Route::get('/detallesalida/show/{id}', [DetalleSalidaController::class, 'show'])->name('detallesalida.show');

Route::get('/productobodegas', [ProductoBodegaController::class, 'index'])->name('productobodegas');
Route::get('/productobodega/create', [ProductoBodegaController::class, 'create'])->name('productobodega.create');
Route::post('/productobodega/store', [ProductoBodegaController::class, 'store'])->name('productobodega.store');
Route::get('/productobodega/edit/{id}', [ProductoBodegaController::class, 'edit'])->name('productobodega.edit');
Route::post('/productobodega/update/{id}', [ProductoBodegaController::class, 'update'])->name('productobodega.update');
Route::delete('/productobodega/delete/{id}', [ProductoBodegaController::class, 'destroy'])->name('productobodega.delete');
Route::get('/productobodega/show/{id}', [ProductoBodegaController::class, 'show'])->name('productobodega.show');

Route::get('/tipopagos', [TipoPagoController::class, 'index'])->name('tipopagos');
Route::get('/tipopago/create', [TipoPagoController::class, 'create'])->name('tipopago.create');
Route::post('/tipopago/store', [TipoPagoController::class, 'store'])->name('tipopago.store');
Route::get('/tipopago/edit/{id}', [TipoPagoController::class, 'edit'])->name('tipopago.edit');
Route::post('/tipopago/update/{id}', [TipoPagoController::class, 'update'])->name('tipopago.update');
Route::delete('/tipopago/delete/{id}', [TipoPagoController::class, 'destroy'])->name('tipopago.delete');
Route::get('/tipopago/show/{id}', [TipoPagoController::class, 'show'])->name('tipopago.show');

Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios');
Route::get('/inventario/create', [InventarioController::class, 'create'])->name('inventario.create');
Route::post('/inventario/store', [InventarioController::class, 'store'])->name('inventario.store');
Route::get('/inventario/edit/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');
Route::post('/inventario/update/{id}', [InventarioController::class, 'update'])->name('inventario.update');
Route::delete('/inventario/delete/{id}', [InventarioController::class, 'destroy'])->name('inventario.delete');
Route::get('/inventario/show/{id}', [InventarioController::class, 'show'])->name('inventario.show');

Route::get('/ofertas', [OfertaController::class, 'index'])->name('ofertas');
Route::get('/oferta/create', [OfertaController::class, 'create'])->name('oferta.create');
Route::post('/oferta/store', [OfertaController::class, 'store'])->name('oferta.store');
Route::get('/oferta/edit/{id}', [OfertaController::class, 'edit'])->name('oferta.edit');
Route::post('/oferta/update/{id}', [OfertaController::class, 'update'])->name('oferta.update');
Route::delete('/oferta/delete/{id}', [OfertaController::class, 'destroy'])->name('oferta.delete');
Route::get('/oferta/show/{id}', [OfertaController::class, 'show'])->name('oferta.show');

Route::get('/inventarioofertas', [InventarioOfertaController::class, 'index'])->name('inventarioofertas');
Route::get('/inventariooferta/create', [InventarioOfertaController::class, 'create'])->name('inventariooferta.create');
Route::post('/inventariooferta/store', [InventarioOfertaController::class, 'store'])->name('inventariooferta.store');
Route::get('/inventariooferta/edit/{id}', [InventarioOfertaController::class, 'edit'])->name('inventariooferta.edit');
Route::post('/inventariooferta/update/{id}', [InventarioOfertaController::class, 'update'])->name('inventariooferta.update');
Route::delete('/inventariooferta/delete/{id}', [InventarioOfertaController::class, 'destroy'])->name('inventariooferta.delete');
Route::get('/inventariooferta/show/{id}', [InventarioOfertaController::class, 'show'])->name('inventariooferta.show');

Route::get('/ventas', [VentaController::class, 'index'])->name('ventas');
Route::get('/venta/create', [VentaController::class, 'create'])->name('venta.create');
Route::post('/venta/store', [VentaController::class, 'store'])->name('venta.store');
Route::get('/venta/procesar/{id}', [VentaController::class, 'procesar'])->name('venta.procesar');
Route::get('/venta/edit/{id}', [VentaController::class, 'edit'])->name('venta.edit');
Route::post('/venta/update/{id}', [VentaController::class, 'update'])->name('venta.update');
Route::delete('/venta/delete/{id}', [VentaController::class, 'destroy'])->name('venta.delete');
Route::get('/venta/cancel/{id}', [VentaController::class, 'destroy'])->name('venta.cancel');
Route::get('/venta/show/{id}', [VentaController::class, 'show'])->name('venta.show');

Route::get('/detalleventas/{id}', [DetalleVentaController::class, 'index'])->name('detalleventas');
Route::get('/detalleventa/create/{id}', [DetalleVentaController::class, 'create'])->name('detalleventa.create');
Route::post('/detalleventa/store', [DetalleVentaController::class, 'store'])->name('detalleventa.store');
Route::get('/detalleventa/edit/{id}', [DetalleVentaController::class, 'edit'])->name('detalleventa.edit');
Route::post('/detalleventa/update/{id}', [DetalleVentaController::class, 'update'])->name('detalleventa.update');
Route::delete('/detalleventa/delete/{id}', [DetalleVentaController::class, 'destroy'])->name('detalleventa.delete');
Route::get('/detalleventa/show/{id}', [DetalleVentaController::class, 'show'])->name('detalleventa.show');

Route::get('/devoluciones', [DevolucionController::class, 'index'])->name('devoluciones');
Route::get('/devolucion/create/{id}', [DevolucionController::class, 'create'])->name('devolucion.create');
Route::post('/devolucion/store', [DevolucionController::class, 'store'])->name('devolucion.store');
Route::get('/devolucion/edit/{id}', [DevolucionController::class, 'edit'])->name('devolucion.edit');
Route::post('/devolucion/update/{id}', [DevolucionController::class, 'update'])->name('devolucion.update');
Route::delete('/devolucion/delete/{id}', [DevolucionController::class, 'destroy'])->name('devolucion.delete');
Route::get('/devolucion/show/{id}', [DevolucionController::class, 'show'])->name('devolucion.show');
