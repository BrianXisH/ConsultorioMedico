<?php
// app/Console/Commands/ImportLocationsFromCSV.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Colonia;
use Illuminate\Support\Facades\DB;

class ImportLocationsFromCSV extends Command
{
    protected $signature = 'import:locations-from-csv';
    protected $description = 'Importar estados, municipios y colonias desde archivos CSV';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::transaction(function () {
            $this->importEstados();
            $this->importMunicipios();
            
        });
    }

    private function importEstados()
    {
        $file = storage_path('app/estados.csv');
        $data = $this->readCSV($file);

        foreach ($data as $row) {
            Estado::create([
                'nombre' => $row[1],
                'abreviatura' => $row[2]
            ]);
        }

        $this->info('Estados importados correctamente.');
    }

    private function importMunicipios()
    {
        $file = storage_path('app/municipios.csv');
        $data = $this->readCSV($file);

        foreach ($data as $row) {
            $estado = Estado::where('id', $row[0])->first();
            if ($estado) {
                Municipio::create([
                    'nombre' => $row[2],
                    'estado_id' => $estado->id,
                ]);
            }
        }

        $this->info('Municipios importados correctamente.');
    }

   

    private function readCSV($file)
    {
        $rows = array_map('str_getcsv', file($file));
        array_shift($rows); // Eliminar encabezado
        return $rows;
    }
}
