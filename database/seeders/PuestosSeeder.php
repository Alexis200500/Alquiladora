<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\puesto;
use Carbon\Carbon;

class PuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        puesto::insert(
            [
                [
                    'puesto'=>'Dueño',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]
            ]
        );
    }
}
