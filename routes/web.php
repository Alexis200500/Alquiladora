<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DetalleEventoController;
use App\Http\Controllers\MaterialesController;
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
/* Route::get('/', function () {
    return view('welcome');
})->name('welcome');
 */

 
Route::get('estados',[App\Http\Controllers\EstadoController::class,'estados'])->name('estados');
Route::get('alta_estado',[App\Http\Controllers\EstadoController::class,'alta_estado'])->name('alta_estado');
Route::post('guardar_estado',[App\Http\Controllers\EstadoController::class,'guardar_estado'])->name('guardar_estado');
Route::get('desactivar_estado/{id_estado}',[App\Http\Controllers\EstadoController::class,'desactivar_estado'])->name('desactivar_estado');
Route::get('activar_estado/{id_estado}',[App\Http\Controllers\EstadoController::class,'activar_estado'])->name('activar_estado');
Route::get('eliminar_estado/{id_estado}',[App\Http\Controllers\EstadoController::class,'eliminar_estado'])->name('eliminar_estado');
Route::get('modificar_estado/{id_estado}',[App\Http\Controllers\EstadoController::class,'modificar_estado'])->name('modificar_estado');
Route::post('editar_estado',[App\Http\Controllers\EstadoController::class,'editar_estado'])->name('editar_estado');
Route::get('PDFestados',[App\Http\Controllers\EstadoController::class,'PDFestados'])->name('PDFestados');
Route::get('Estadosexcel',[App\Http\Controllers\EstadoController::class,'Estadosexcel'])->name('Estadosexcel');
Route::post('import',[App\Http\Controllers\EstadoController::class,'import'])->name('import');

Route::controller(ClienteController::class)->group(function(){
  Route::get('clientes','clientes')->name('clientes');
  Route::get('agregar_cliente','agregar_cliente')->name('agregar_cliente');
  Route::post('guardar_cliente','guardar_cliente')->name('guardar_cliente');
  Route::get('desactivar_cliente/{id_cliente}','desactivar_cliente')->name('desactivar_cliente');
  Route::get('activar_cliente/{id_cliente}','activar_cliente')->name('activar_cliente');
  Route::get('eliminar_cliente/{id_cliente}','eliminar_cliente')->name('eliminar_cliente');
  Route::get('editar_cliente/{id_cliente}','editar_cliente')->name('editar_cliente');
  Route::post('modificar_cliente','modificar_cliente')->name('modificar_cliente');
  Route::get('PDFClientes','PDFClientes')->name('PDFClientes');
  Route::get('ClientesExcelExportar','ClientesExcelExportar')->name('ClientesExcelExportar');
  Route::post('ClientesImportar','ClientesImportar')->name('ClientesImportar');
});

Route::get('puestos',[PuestoController::class,'puestos'])->name('puestos');
Route::get('alta_puesto',[PuestoController::class,'alta_puesto'])->name('alta_puesto');
Route::post('guardar_puesto',[PuestoController::class,'guardar_puesto'])->name('guardar_puesto');
Route::get('desactivar_puesto/{id_puesto}',[PuestoController::class,'desactivar_puesto'])->name('desactivar_puesto');
Route::get('activar_puesto/{id_puesto}',[PuestoController::class,'activar_puesto'])->name('activar_puesto');
Route::get('editar_puesto/{id_puesto}',[PuestoController::class,'editar_puesto'])->name('editar_puesto');
Route::get('eliminar_puesto/{id_puesto}',[PuestoController::class,'eliminar_puesto'])->name('eliminar_puesto');
Route::post('modificar_puesto',[PuestoController::class,'modificar_puesto'])->name('modificar_puesto');
Route::get('PDFPuestos',[PuestoController::class,'PDFPuestos'])->name('PDFPuestos');
Route::get('PuestosExcel',[PuestoController::class,'PuestosExcel'])->name('PuestosExcel');
Route::post('Puestosimportar',[PuestoController::class,'Puestosimportar'])->name('Puestosimportar');


Route::controller(App\Http\Controllers\AdminController::class)->group(function(){
  Route::get('admins','admins')->name('admins');
  Route::get('alta_admin','alta_admin')->name('alta_admin');
  Route::post('guardar_admin','guardar_admin')->name('guardar_admin');
  Route::Get('desactivar_admin/{id_admin}','desactivar_admin')->name('desactivar_admin');
  Route::Get('activar_admin/{id_admin}','activar_admin')->name('activar_admin');
  Route::Get('eliminar_admin/{id_admin}','eliminar_admin')->name('eliminar_admin');
  Route::Get('editar_admin/{id_admin}','editar_admin')->name('editar_admin');
  Route::post('cambio_admin','cambio_admin')->name('cambio_admin');
  Route::Get('PDFadmins','PDFadmins')->name('PDFadmins');
  Route::Get('AdminsExport','AdminsExport')->name('AdminsExport');
  Route::Post('AdminsImport','AdminsImport')->name('AdminsImport');
});

Route::controller(ColorController::class)->group(function(){
  Route::get('colores','colores')->name('colores');
  route::Get('agregar_color','agregar_color')->name('agregar_color');
  Route::post('guardar_color','guardar_color')->name('guardar_color');
  Route::get('desactivar_color/{id_color}','desactivar_color')->name('desactivar_color');
  Route::get('activar_color/{id_color}','activar_color')->name('activar_color');
  Route::get('eliminar_color/{id_color}','eliminar_color')->name('eliminar_color');
  Route::get('editar_color/{id_color}','editar_color')->name('editar_color');
  Route::post('cambiar_color','cambiar_color')->name('cambiar_color');
  Route::get('PDFColores','PDFColores')->name('PDFColores');
  Route::get('ColorExport','ColorExport')->name('ColorExport');
  Route::post('ColorImport','ColorImport')->name('ColorImport');
});

Route::controller(App\Http\Controllers\EventoController::class)->group(function(){
  Route::get('eventos','eventos')->name('eventos');
  Route::get('alta_evento','alta_evento')->name('alta_evento');
  Route::post('guardar_evento','guardar_evento')->name('guardar_evento');
  Route::get('desactivar_evento/{id_evento}','desactivar_evento')->name('desactivar_evento');
  Route::get('activar_evento/{id_evento}','activar_evento')->name('activar_evento');
  Route::get('eliminar_evento/{id_evento}','eliminar_evento')->name('eliminar_evento');
  Route::get('editar_evento/{id_evento}','editar_evento')->name('editar_evento');
  Route::post('cambio_evento','cambio_evento')->name('cambio_evento');
  Route::get('PDFEventos','PDFEventos')->name('PDFEventos');
  Route::get('Eventoexportar','Eventoexportar')->name('Eventoexportar');
  Route::post('EventosImportar','EventosImportar')->name('EventosImportar');
});

Route::controller(DetalleEventoController::class)->group(function(){
  Route::GET('detalle_eventos','detalle_eventos')->name('detalle_eventos');
  Route::GET('alta_detalle','alta_detalle')->name('alta_detalle');
  Route::post('guardar_detalle','guardar_detalle')->name('guardar_detalle');
  Route::GET('cancelar_evento/{id_detalle_evento}','cancelar_evento')->name('cancelar_evento');
  Route::GET('editar_detalle/{id_detalle_evento}','editar_detalle')->name('editar_detalle');
  Route::post('cambio_detalle','cambio_detalle')->name('cambio_detalle');
  Route::get('PDFdetalles','PDFdetalles')->name('PDFdetalles');
});

route::controller(App\Http\Controllers\LoginController::class)->group(function(){
  route::get('login','login')->name('login');
  Route::post('validar','validar')->name('validar');
  Route::get('index','index')->name('index');
  route::get('cerrarsession','cerrarsession')->name('cerrarsession');
  route::get('restaurar_vista','restaurar_vista')->name('restaurar_vista');
  Route::post('restaurar','restaurar')->name('restaurar');
  Route::get('crear','crear')->name('crear');
  Route::post('guardar','guardar')->name('guardar');
});


Route::controller(MaterialesController::class)->group(function(){
  Route::get('materiales','materiales')->name('materiales');
  Route::get('agregar_material','agregar_material')->name('agregar_material');
  Route::post('guardar_material','guardar_material')->name('guardar_material');
  Route::get('desactivar_material/{id_material}','desactivar_material')->name('desactivar_material');
  Route::get('activar_material/{id_material}','activar_material')->name('activar_material');
  Route::get('eliminar_material/{id_material}','eliminar_material')->name('eliminar_material');
  Route::get('detalle_material/{id_material}','detalle_material')->name('detalle_material');
  Route::post('editar_material','editar_material')->name('editar_material');
  Route::get('PDFMateriales','PDFMateriales')->name('PDFMateriales');
  Route::get('ExcelMateriales','ExcelMateriales')->name('ExcelMateriales');
  Route::post('ImportarMateriales','ImportarMateriales')->name('ImportarMateriales');
});

