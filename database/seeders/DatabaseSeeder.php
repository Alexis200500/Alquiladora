<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
          [
            EstadosSeeder::class,
            ClientesSeeder::class,
            PuestosSeeder::class,
            AdminsSeeder::class,
            ColoresSeeder::class,
            EventosSeeder::Class,
            Detalle_eventosSeeder::class,
            MaterialesSeeder::class
          ]
        );
    }
}
