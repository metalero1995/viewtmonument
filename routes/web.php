<?php


use App\Http\Controllers\ApiPrivadaController;
use App\Http\Controllers\ApiPublicaController;
use App\Http\Controllers\CatalogoImagenesController;
use App\Http\Controllers\CatalogoMonumentosController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\ConsumoGuzzleController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DelimitacionController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\MonumentoController;
use App\Http\Controllers\MonumentoPublicoController;
use App\Http\Controllers\PaisController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilUsuarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RevisadoReporteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ContactoMongoAllUserController;

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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});
Route::get('nosotros', function () {
    return view('nosotros');
});
Route::get('privacidad', function () {
    return view('privacidad');
});
Route::get('galletas', function () {
    return view('galletas');
});
//route::get('welcome',[BusquedaIAController::class, 'index'])->name('welcome');

/*
Route::get('monumentos', function () {
    return view('monumentos');
});*/
route::get('monumentos',[MonumentoPublicoController::class, 'index'])->name('monumentos');

route::get('usuario/{id}',[PerfilUsuarioController::class, 'index'])->name('usuario');
route::put('usuario/update/{id}', [PerfilUsuarioController::class, 'update'])->name('usuario.update');
route::put('usuario/updatephoto/{id}', [PerfilUsuarioController::class, 'updatephoto'])->name('usuario.updatephoto');



//Pantalla para poder contactarnos sin registrarse.//
route::get('contacto',[ContactanosController::class, 'index'])->name('contacto');
route::post('/contacto_send',[ContactanosController::class, 'store'])->name('contacto_send');

require __DIR__.'/auth.php';
route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

route::get('/perfiles',[PerfilController::class, 'index'])->name('perfil.index');
route::get('/perfiles/create',[PerfilController::class, 'create'])->name('perfil.create');
route::post('/perfiles/store',[PerfilController::class, 'store'])->name('perfil.store');
route::get('/perfiles/edit/{id}',[PerfilController::class, 'edit'])->name('perfil.edit');
route::put('/perfiles/update/{id}', [PerfilController::class, 'update'])->name('perfil.update');
route::delete('/perfiles/delete/{id}', [PerfilController::class, 'destroy'])->name('perfil.destroy');

route::get('/user',[UserController::class, 'index'])->name('user.index');
route::get('/user/create',[UserController::class, 'create'])->name('user.create');
route::post('/user/store',[UserController::class, 'store'])->name('user.store');
route::get('/user/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

route::get('/user_edit/{id}',[UserController::class, 'show'])->name('user_edit.index'); //Edición de usuario

route::get('/pais',[PaisController::class, 'index'])->name('pais.index');
route::get('/pais/create',[PaisController::class, 'create'])->name('pais.create');
route::post('/pais/store',[PaisController::class, 'store'])->name('pais.store');
route::get('/pais/edit/{id}',[PaisController::class, 'edit'])->name('pais.edit');
route::put('/pais/update/{id}', [PaisController::class, 'update'])->name('pais.update');
route::delete('/pais/delete/{id}', [PaisController::class, 'destroy'])->name('pais.destroy');

route::get('/estado',[EstadoController::class, 'index'])->name('estado.index');
route::get('/estado/create',[EstadoController::class, 'create'])->name('estado.create');
route::post('/estado/store',[EstadoController::class, 'store'])->name('estado.store');
route::get('/estado/edit/{id}',[EstadoController::class, 'edit'])->name('estado.edit');
route::put('/estado/update/{id}', [EstadoController::class, 'update'])->name('estado.update');
route::delete('/estado/delete/{id}', [EstadoController::class, 'destroy'])->name('estado.destroy');


route::get('/ciudad',[CiudadController::class, 'index'])->name('ciudad.index');
route::get('/ciudad/create',[CiudadController::class, 'create'])->name('ciudad.create');
route::post('/ciudad/store',[CiudadController::class, 'store'])->name('ciudad.store');
route::get('/ciudad/edit/{id}',[CiudadController::class, 'edit'])->name('ciudad.edit');
route::put('/ciudad/update/{id}', [CiudadController::class, 'update'])->name('ciudad.update');
route::delete('/ciudad/delete/{id}', [CiudadController::class, 'destroy'])->name('ciudad.destroy');

route::get('/reporte',[ReporteController::class, 'index'])->name('reporte.index'); //reportes
route::get('/reporte/create',[ReporteController::class, 'create'])->name('reporte.create');
route::post('/reporte/store',[ReporteController::class, 'store'])->name('reporte.store');
route::get('/reporte/edit/{id}',[ReporteController::class, 'edit'])->name('reporte.edit');
route::put('/reporte/update/{id}', [ReporteController::class, 'update'])->name('reporte.update');
route::delete('/reporte/delete/{id}', [ReporteController::class, 'destroy'])->name('reporte.destroy');

route::get('/reporte_estatus',[RevisadoReporteController::class, 'index'])->name('reporte_estatus.index'); //reportes
route::get('/reporte_estatus/create',[RevisadoReporteController::class, 'create'])->name('reporte_estatus.create');
route::post('/reporte_estatus/store',[RevisadoReporteController::class, 'store'])->name('reporte_estatus.store');
route::get('/reporte_estatus/edit/{id}',[RevisadoReporteController::class, 'edit'])->name('reporte_estatus.edit');
route::put('/reporte_estatus/update/{id}', [RevisadoReporteController::class, 'update'])->name('reporte_estatus.update');
route::delete('/reporte_estatus/delete/{id}', [RevisadoReporteController::class, 'destroy'])->name('reporte_estatus.destroy');


route::get('/monumento',[MonumentoController::class, 'index'])->name('monumento.index');
route::get('/monumento/create',[MonumentoController::class, 'create'])->name('monumento.create');
route::post('/monumento/store',[MonumentoController::class, 'store'])->name('monumento.store');
route::get('/monumento/edit/{id}',[MonumentoController::class, 'edit'])->name('monumento.edit');
route::put('/monumento/update/{id}',[MonumentoController::class, 'update'])->name('monumento.update');
route::delete('/monumento/delete/{id}',[MonumentoController::class, 'destroy'])->name('monumento.destroy');

route::get('/catMonumento',[CatalogoMonumentosController::class, 'index'])->name('catMonumento.index');
route::get('/catMonumento/create',[CatalogoMonumentosController::class, 'create'])->name('catMonumento.create');
route::post('/catMonumento/store',[CatalogoMonumentosController::class, 'store'])->name('catMonumento.store');
route::get('/catMonumento/edit/{id}',[CatalogoMonumentosController::class, 'edit'])->name('catMonumento.edit');
route::put('/catMonumento/update/{id}',[CatalogoMonumentosController::class, 'update'])->name('catMonumento.update');
route::delete('/catMonumento/delete/{id}',[CatalogoMonumentosController::class, 'destroy'])->name('catMonumento.destroy');

route::get('/imagenes',[ImagenController::class, 'index'])->name('imagenes.index');
route::get('/imagenes/create',[ImagenController::class, 'create'])->name('imagenes.create');
route::post('/imagenes/store',[ImagenController::class, 'store'])->name('imagenes.store');
route::get('/imagenes/edit/{id}',[ImagenController::class, 'edit'])->name('imagenes.edit');
route::put('/imagenes/update/{id}',[ImagenController::class, 'update'])->name('imagenes.update');
route::delete('/imagenes/delete/{id}',[ImagenController::class, 'destroy'])->name('imagenes.destroy');

route::get('/catImagen',[CatalogoImagenesController::class, 'index'])->name('catImagen.index');
route::get('/catImagen/create',[CatalogoImagenesController::class, 'create'])->name('catImagen.create');
route::post('/catImagen/store',[CatalogoImagenesController::class, 'store'])->name('catImagen.store');
route::get('/catImagen/edit/{id}',[CatalogoImagenesController::class, 'edit'])->name('catImagen.edit');
route::put('/catImagen/update/{id}',[CatalogoImagenesController::class, 'update'])->name('catImagen.update');
route::delete('/catImagen/delete/{id}',[CatalogoImagenesController::class, 'destroy'])->name('catImagen.destroy');

//Comentarios
route::get('/comentarios',[ComentariosController::class, 'index'])->name('comentarios.index');
route::get('/comentarios/create',[ComentariosController::class, 'create'])->name('comentarios.create');
route::post('/comentarios/store',[ComentariosController::class, 'store'])->name('comentarios.store');
route::get('/comentarios/edit/{id}',[ComentariosController::class, 'edit'])->name('comentarios.edit');
route::put('/comentarios/update/{id}',[ComentariosController::class, 'update'])->name('comentarios.update');
route::delete('/comentarios/delete/{id}',[ComentariosController::class, 'destroy'])->name('comentarios.destroy');

//valoracion
route::get('/valoracion',[ValoracionController::class, 'index'])->name('valoracion.index');
route::get('/valoracion/create',[ValoracionController::class, 'create'])->name('valoracion.create');
route::post('/valoracion/store',[ValoracionController::class, 'store'])->name('valoracion.store');
route::get('/valoracion/edit/{id}',[ValoracionController::class, 'edit'])->name('valoracion.edit');
route::put('/valoracion/update/{id}',[ValoracionController::class, 'update'])->name('valoracion.update');
route::delete('/valoracion/delete/{id}',[ValoracionController::class, 'destroy'])->name('valoracion.destroy');

//delimitaciones
route::get('/delimitaciones',[DelimitacionController::class, 'index'])->name('delimitacion.index');
route::get('/delimitaciones/create',[DelimitacionController::class, 'create'])->name('delimitacion.create');
route::post('/delimitaciones/store',[DelimitacionController::class, 'store'])->name('delimitacion.store');
route::get('/delimitaciones/edit/{id}',[DelimitacionController::class, 'edit'])->name('delimitacion.edit');
route::delete('/delimitaciones/delete/{id}',[DelimitacionController::class, 'destroy'])->name('delimitacion.destroy');
route::put('/delimitaciones/update/{id}',[DelimitacionController::class, 'update'])->name('delimitacion.update');

//APIS PRIVADAS
route::get('/obra',[ConsumoGuzzleController::class, 'index'])->name('guzzle');
route::get('/apiPrivada/mostrarEstados/{id}/niveles', [ApiPrivadaController::class, 'mostrarEstados']);
route::get('/apiPrivada/mostrarCiudades/{id}/niveles', [ApiPrivadaController::class, 'mostrarCiudades']);
/*
//APIS MOVIL
//Route::get('/apiMonumento/mostrarMonumentos', [ApiMonumentoController::class, 'index']);
Route::middleware('auth')->get('/api/monumentos', [ApiMonumentoController::class, 'index']);

Route::get('/comentarios', [ComentarioController::class, 'index']);
Route::get('/comentarios/{id}', [ComentarioController::class, 'show']);
Route::post('/comentarios', [ComentarioController::class, 'store']);
Route::put('/comentarios/{id}', [ComentarioController::class, 'update']);
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy']);
Route::get('/comentarios/usuario/{id_usuario}/monumento/{id_monumento}', [ComentarioController::class, 'byUserAndMonument']);

Route::post('/registro', [App\Http\Controllers\ApiLoginRegistroController::class, 'registro']);
Route::post('/login', [App\Http\Controllers\ApiLoginRegistroController::class, 'login']);

Route::get('/perfil/{id}', [Perfil::class, 'show']);*/

//APIS PUBLICAS
route::get('/apiPublica/mostrarEstados/{id}/niveles', [ApiPublicaController::class, 'mostrarEstados']);
route::get('/apiPublica/mostrarCiudades/{id}/niveles', [ApiPublicaController::class, 'mostrarCiudades']);

route::get('/apiPublica/mostrarModalMonumentos/{id}/niveles', [ApiPublicaController::class, 'mostrarModalMonumentos']);
route::get('/apiPublica/mostrarComentariosMonumentos/{id}/niveles', [ApiPublicaController::class, 'mostrarComentariosMonumentos']);
route::get('/apiPublica/mostrarComentariosMonumentosV2/{id}/{limit}/niveles', [ApiPublicaController::class, 'mostrarComentariosMonumentosV2']);
route::get('/apiPublica/totalComentariosMonumentos/{id}/niveles', [ApiPublicaController::class, 'totalComentariosMonumentos']);
route::post('/apiPublica/guardarComentario', [ApiPublicaController::class, 'guardarComentario']);
route::get('/apiPublica/buscarInteraccion/{id_monumento}/{id_usuario}/niveles', [ApiPublicaController::class, 'buscarInteraccion']);
route::post('/apiPublica/crearInteraccion', [ApiPublicaController::class, 'crearInteraccion']);

route::put('/apiPublica/actualizarInteraccion/{id}', [ApiPublicaController::class, 'actualizarInteraccion']);


route::get('/apiPublica/mostrarRaiting', [ApiPublicaController::class, 'mostrarRaiting']);
route::get('/apiPublica/mostrarRaitingPersona/{id_usuario}/{id_monumento}', [ApiPublicaController::class, 'mostrarRaitingPersona']);

//Rutas para el modulo del dashboard de reportes
route::get('/reporte',[ContactoController::class, 'index'])->name('reporte.index');
route::post('/contacto_envio',[ContactoController::class, 'store'])->name('contacto_envio');
route::delete('/reporte/delete/{id}',[ContactoController::class, 'destroy'])->name('reporte.destroy');
route::get('/reporte/edit/{id}',[ContactoController::class, 'edit'])->name('contacto.edit');
route::put('/reporte/update/{id}',[ContactoController::class, 'update'])->name('contacto.update');

//Rutas para la vista de la pagina de contactanos
route::post('/contacto_envioAll',[ContactoMongoAllUserController::class, 'store'])->name('contacto_envioAll');