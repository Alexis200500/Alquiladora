<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\evento;
use Carbon\Carbon;

class EventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        evento::insert(
            [
                [
                    'evento'=>'XV años',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]
            ]
        );
    }
}
