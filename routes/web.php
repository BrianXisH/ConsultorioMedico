<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\FamilyHistoryController;
use App\Http\Controllers\NoPatologicoController;
use App\Http\Controllers\PersonalPatologicoController;
use App\Http\Controllers\BusquedaPacienteController;
use App\Http\Controllers\ExploracionFisicaController;
use App\Http\Controllers\InterrogatorioController;
use App\Http\Controllers\HabitusController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\IdentificacionEController;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

//Route::get('/', function () {return view('welcome'); });
Route::get('/', [WelcomeController::class, 'estadisticas'])->name('welcome');


Auth::routes();
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta para mostrar el formulario de creación de posts


Route::get('/identification', [IdentificationController::class, 'index'])->name('identification');
Route::post('/identification', [IdentificationController::class, 'procesarFormulario'])->name('ficha.store');
Route::get('/identification_existente', [IdentificacionEController::class, 'index'])->name('identification.index');
Route::post('/identification_existente', [IdentificacionEController::class, 'procesarFormulario'])->name('submitForm');

Route::get('/antecedentes_patologicos_hereditarios', [FamilyHistoryController::class, 'index'])->name('antecedenes_patologicos_hereditarios');
Route::post('/antecedentes_patologicos_hereditarios', [FamilyHistoryController::class, 'store'])->name('familyHistory.store');

Route::get('/antecedentes_personales_no_patologicos', [NoPatologicoController::class, 'index'])->name('nonPathological.create');
Route::post('/antecedentes_personales_no_patologicos', [NoPatologicoController::class, 'store'])->name('nonPathological.store');

Route::get('/antecedentes_personales_patologicos', [PersonalPatologicoController::class, 'index'])->name('pathological.index');
Route::post('/antecedentes_personales_patologicos', [PersonalPatologicoController::class, 'store'])->name('pathological.store');


Route::get('/busqueda_pacientes', [BusquedaPacienteController::class, 'index'])->name('pacientes.index');
Route::get('/busqueda_pacientes/{id}', [BusquedaPacienteController::class, 'show'])->name('pacientes.show');

Route::get('/busqueda_pacientes_nuevo', [BusquedaPacienteController::class, 'index_nueva'])->name('busqueda.index');
Route::get('/busqueda_pacientes_nuevo/{id}', [BusquedaPacienteController::class, 'show_nueva'])->name('busqueda.show');


// Ruta para mostrar el formulario
Route::get('/exploracion', [ExploracionFisicaController::class, 'index'])->name('exploracion.index');
Route::post('/exploracion', [ExploracionFisicaController::class, 'store'])->name('exploracion.store');


Route::get('/interrogatorio', [InterrogatorioController::class, 'index'])->name('interrogatorio.index');
Route::post('/interrogatorio', [InterrogatorioController::class, 'store'])->name('interrogatorio.store');
Route::post('/habitus', [HabitusController::class, 'store'])->name('habitus.store');


Route::get('/nueva_consulta', [ConsultaController::class, 'crearNueva'])->name('consultas.nueva');
Route::get('/consultas/existente', [ConsultaController::class, 'crearExistente'])->name('consultas.existente');
Route::get('/registrar_paciente', [ConsultaController::class, 'registrar'])->name('paciente.registrar');


// Rutas para generación de PDF
Route::get('/generarpdf', [PdfController::class, 'index'])->name('receta.show');
Route::get('/recetanueva', [PdfController::class, 'recetanueva'])->name('receta.nueva');


Route::get('/api/municipios/{estado_id}', [IdentificationController::class, 'getMunicipios']);
Route::get('/api/colonias/{municipio_id}', [IdentificationController::class, 'getColonias']);