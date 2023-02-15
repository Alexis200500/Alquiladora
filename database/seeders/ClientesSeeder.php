<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\cliente;
use Carbon\Carbon;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        cliente::insert([
            [
                'nombre'=>'Alexis',
                'apellido_paterno'=>'Morales',
                'apellido_materno'=>'Gómez',
                'edad'=>22,
                'sexo'=>'M',
                'telefono'=>'1234567890',
                'direccion'=>'Cerrada Felipe Chávez int 7',
                'imagen'=>'sinfoto.jpg',
                'email'=>'alex@gmail.com',
                'password'=>'lkslkasdklaskld',
                'id_estado'=>1,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]
        ]);
    }
}
