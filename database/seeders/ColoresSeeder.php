<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\color;
use Carbon\Carbon;

class ColoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        color::insert(
            [
                [
                    'color'=>'azul',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ],
                [
                    'color'=>'rojo',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ],
            ]
        );            
    }
}
