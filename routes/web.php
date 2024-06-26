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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CitaController;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;



Auth::routes();
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Rutas para el AdminController
    Route::get('/admin/medicos', [AdminController::class, 'index'])->name('admin.medicos.index');
    Route::get('/admin/medicos/create', [AdminController::class, 'create'])->name('admin.medicos.create');
    Route::post('/admin/medicos', [AdminController::class, 'store'])->name('admin.medicos.store');
    Route::get('/admin/medicos/{id}/edit', [AdminController::class, 'edit'])->name('admin.medicos.edit');
    Route::put('/admin/medicos/{id}', [AdminController::class, 'update'])->name('admin.medicos.update');
    Route::delete('/admin/medicos/{id}', [AdminController::class, 'destroy'])->name('admin.medicos.destroy');
    Route::get('/admin/medicos/{id}/historial', [AdminController::class, 'historial'])->name('admin.medicos.historial');
});

Route::middleware(['auth', 'role:medico'])->group(function () {

    Route::get('/', [WelcomeController::class, 'estadisticas'])->name('welcome');
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

    Route::get('/pacientes/buscarConFicha', [BusquedaPacienteController::class, 'buscarPacientesConFicha'])->name('pacientes.buscarConFicha');

    Route::get('/busqueda_pacientes', [BusquedaPacienteController::class, 'index'])->name('pacientes.index');
    Route::get('/busqueda_pacientes/{id}', [BusquedaPacienteController::class, 'show'])->name('pacientes.show');

    Route::get('/busqueda_pacientes_nuevo', [BusquedaPacienteController::class, 'index_nueva'])->name('busqueda.index');
    Route::get('/busqueda_pacientes_nuevo/{id}', [BusquedaPacienteController::class, 'show_nueva'])->name('busqueda.show');

    Route::get('/exploracion', [ExploracionFisicaController::class, 'index'])->name('exploracion.index');
    Route::post('/exploracion', [ExploracionFisicaController::class, 'store'])->name('exploracion.store');

    Route::get('/interrogatorio', [InterrogatorioController::class, 'index'])->name('interrogatorio.index');
    Route::post('/interrogatorio', [InterrogatorioController::class, 'store'])->name('interrogatorio.store');
    Route::post('/habitus', [HabitusController::class, 'store'])->name('habitus.store');

    Route::get('/nueva_consulta', [ConsultaController::class, 'crearNueva'])->name('consultas.nueva');
    Route::get('/consultas/existente', [ConsultaController::class, 'crearExistente'])->name('consultas.existente');
    Route::get('/registrar_paciente', [ConsultaController::class, 'registrar'])->name('paciente.registrar');

    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

    Route::get('/busqueda_pacientes/{id}/consultas', [BusquedaPacienteController::class, 'verConsultas'])->name('pacientes.consultas');
    
    Route::get('/busqueda_pacientes/{id}/antecedentes', [BusquedaPacienteController::class, 'verAntecedentes'])->name('pacientes.antecedentes');
   
});








Route::get('/generarpdf', [PdfController::class, 'index'])->name('receta.show');
Route::get('/recetanueva', [PdfController::class, 'recetanueva'])->name('receta.nueva');

Route::get('/api/municipios/{estado_id}', [IdentificationController::class, 'getMunicipios']);
Route::get('/api/colonias/{municipio_id}', [IdentificationController::class, 'getColonias']);
