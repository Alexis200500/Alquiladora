<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\estado;
use Carbon\Carbon;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        estado::insert(
            [
                [
                    'estado'=>'México',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]
            ]
        );
    }
}
