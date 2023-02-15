<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\materiales;
use Carbon\Carbon;
class MaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        materiales::insert(
            [
                [
                    'material'=>'Loza',
                    'imagen'=>'sinfoto.jpg',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]
            ]
        );
    }
}
