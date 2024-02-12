<?php

use App\Http\Controllers\Admin\AduanaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CostoController;
use App\Http\Controllers\Admin\CotizacionController;
use App\Http\Controllers\Admin\CuentaBancariaController;
use App\Http\Controllers\Admin\CuentaController;
use App\Http\Controllers\Admin\CXCobrarController;
use App\Http\Controllers\Admin\CXPagarController;
use App\Http\Controllers\Admin\DocumentoFicalController;
use App\Http\Controllers\Admin\DocumentosFisalesTipoController;
use App\Http\Controllers\Admin\DocumentosFiscalesRangoController;
use App\Http\Controllers\Admin\EmbarqueController;
use App\Http\Controllers\Admin\FacturaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MonedaController;
use App\Http\Controllers\Admin\PagosController;
use App\Http\Controllers\Admin\ParameterController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProformaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TiposPersonaController;
use App\Http\Controllers\Admin\ValueTypeController;
use Illuminate\Support\Facades\Route;


Route::get('',[HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('users',UserController::class)->only(['index','edit','update'])->names('admin.users');

Route::resource('parameters',ParameterController::class)->except(['show','destroy'])->names('admin.parameters');
Route::resource('roles',RoleController::class)->except('show')->names('admin.roles');



Route::resource('tipoPersonas',TiposPersonaController::class)->except(['show','destroy'])->names('admin.tipoPersonas');
Route::resource('aduanas',AduanaController::class)->except(['show','destroy'])->names('admin.aduanas');
Route::resource('tipoDocumentosFiscales',DocumentosFisalesTipoController::class)->except(['show','destroy'])->names('admin.tipoDocumentosFiscales');
Route::resource('rangoDocumentosFiscales',DocumentosFiscalesRangoController::class)->except(['show','destroy'])->names('admin.rangoDocumentosFiscales'); 
Route::resource('valueTypes',ValueTypeController::class)->except(['show','destroy'])->names('admin.valueTypes'); 
Route::resource('monedas',MonedaController::class)->except(['show','destroy'])->names('admin.monedas'); 
Route::resource('cuentas',CuentaController::class)->except(['show','destroy'])->names('admin.cuentas'); 
Route::resource('personas',PersonaController::class)->except(['show','destroy'])->names('admin.personas'); 
Route::resource('cuentasBancarias',CuentaBancariaController::class)->except(['show','destroy'])->names('admin.cuentasBancarias'); 
Route::resource('servicios',ServicioController::class)->except(['show','destroy'])->names('admin.servicios'); 
Route::resource('cotizaciones',CotizacionController::class)->except(['show','destroy'])->names('admin.cotizaciones'); 
Route::get('cotizaciones/{cotizacione}/{moneda}/generarPDF', [CotizacionController::class,'generarPDF'])->name('admin.cotizaciones.generarPDF');
//Route::get('cotizaciones/pdf/estimate.pdf', [CotizacionController::class,'pdf'])->name('admin.cotizaciones.pdf');
Route::resource('embarques',EmbarqueController::class)->except(['show','destroy'])->names('admin.embarques'); 
Route::get('embarques/{cotizacione}/createEmbarqueCotizacione', [EmbarqueController::class,'createEmbarqueCotizacione'])->name('admin.embarques.createEmbarqueCotizacione');
Route::get('embarques/{embarque}/createSubEmbarque', [EmbarqueController::class,'createSubEmbarque'])->name('admin.embarques.createSubEmbarque');
Route::resource('proformas',ProformaController::class)->except(['show','destroy'])->names('admin.proformas'); 

/*Route::controller('proformas',ProformaController::class)->group(function(){
    Route::get('proformas/{embarque}/createProformaEmbarque','proformas')->name('admin.proformas.createProformaEmbarque');
      Route::post('proformas','storeProformaEmbarque')->name('cursos.storeProformaEmbarque');
 });*/
/* Route::controller(ProformaController::class)->group(function(){
    Route::get('proformas/{embarque}/createProformaEmbarque','proformas')->name('admin.proformas.createProformaEmbarque');
}); */
Route::get('proformas/{embarque}/createProformaEmbarque', [ProformaController::class,'createProformaEmbarque'])->name('admin.proformas.createProformaEmbarque');
Route::get('proformas/{cotizacione}/createProformaCotizacion', [ProformaController::class,'createProformaCotizacion'])->name('admin.proformas.createProformaCotizacion');
Route::get('proformas/{proforma}/{moneda}/generarPDF', [ProformaController::class,'generarPDF'])->name('admin.proformas.generarPDF');
//Route::post('proformas/storeProformaEmbarque', [ProformaController::class,'storeProformaEmbarque'])->name('cursos.storeProformaEmbarque');
Route::post('proformas/storeProformaEmbarque', [ProformaController::class,'storeProformaEmbarque'])->name('admin.proformas.storeProformaEmbarque');
Route::resource('documentosFiscales',DocumentoFicalController::class)->except(['show','destroy'])->names('admin.documentosFiscales'); 
Route::get('documentosFiscales/{embarque}/createDocumentoFiscalEmbarque', [DocumentoFicalController::class,'createDocumentoFiscalEmbarque'])->name('admin.documentosFiscales.createDocumentoFiscalEmbarque');
Route::post('documentosFiscales/storeDocumentoFiscalEmbarque', [DocumentoFicalController::class,'storeDocumentoFiscalEmbarque'])->name('admin.documentosFiscales.storeDocumentoFiscalEmbarque');
Route::get('documentosFiscales/{documentoFiscal}/{moneda}/generarPDF', [DocumentoFicalController::class,'generarPDF'])->name('admin.documentosFiscales.generarPDF');

Route::resource('pagos',PagosController::class)->except(['show','destroy'])->names('admin.pagos'); 
Route::get('pagos/{documentoFiscal}/createDocumentoFiscalPago', [PagosController::class,'createDocumentoFiscalPago'])->name('admin.pagos.createDocumentoFiscalPago');
Route::get('pagos/{pago}/{moneda}/generarPDF', [PagosController::class,'generarPDF'])->name('admin.pagos.generarPDF');

Route::resource('costos',CostoController::class)->except(['show','destroy'])->names('admin.costos'); 
Route::get('costos/{costo}/createEmbarquePago', [CostoController::class,'createEmbarquePago'])->name('admin.costos.createEmbarquePago');
Route::put('costos/storePago/{costo}', [CostoController::class,'storePago'])->name('admin.costos.storePago');
Route::get('costos/{costo}/{moneda}/generarPDF', [CostoController::class,'generarPDF'])->name('admin.costos.generarPDF');

Route::resource('cxc',CXCobrarController::class)->only(['index'])->names('admin.cxc'); 
Route::post('cxc/generarPDF', [CXCobrarController::class,'generarPDF'])->name('admin.cxc.generarPDF');

Route::resource('cxp',CXPagarController::class)->only(['index'])->names('admin.cxp'); 
Route::post('cxp/generarPDF', [CXPagarController::class,'generarPDF'])->name('admin.cxp.generarPDF');


Route::resource('categories',CategoryController::class)->except('show')->names('admin.categories');
Route::resource('tags',TagController::class)->except('show')->names('admin.tags');
Route::resource('posts',PostController::class)->except('show')->names('admin.posts');