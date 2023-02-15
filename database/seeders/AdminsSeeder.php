<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::insert(
            [
                [
                    'nombre'=>'Alexis',
                    'apellido_paterno'=>'Alexis',
                    'apellido_materno'=>'Alexis',
                    'edad'=>22,
                    'sexo'=>'M',
                    'telefono'=>'Alexis',
                    'direccion'=>'Alexis',
                    'id_estado'=>1,
                    'id_puesto'=>1,
                    'imagen'=>'Alexis',
                    'email'=>'alexis.azulcrema4@gmail.com',
                    'password'=>Hash::make('Alexis'),
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]
            ]
        );
    }
}
