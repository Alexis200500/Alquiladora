<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\detalle_evento;
use Carbon\Carbon;

class Detalle_eventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        detalle_evento::insert(
            [
                [
                    'id_cliente'=>1,
                    'id_evento'=>1,
                    'direccion'=>'San Pedro',
                    'id_estado'=>1,
                    'fecha_evento'=>'2023-01-01',
                    'costo'=>4000,
                    'cantidad_personas'=>50,
                    'id_admin'=>1,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]
            ]
        );    
    }
}
