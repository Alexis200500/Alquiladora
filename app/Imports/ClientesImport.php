<?php

namespace App\Imports;

use App\Models\cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ClientesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new cliente([
            'nombre'=>$row['nombre'],
            'apellido_paterno'=>$row['apellido_paterno'],
            'apellido_materno'=>$row['apellido_materno'],
            'edad'=>$row['edad'],
            'sexo'=>$row['sexo'],
            'telefono'=>$row['telefono'],
            'direccion'=>$row['direccion'],

            'imagen'=>'sinfoto.jpg',
            
            'email'=>$row['email'],
            'password'=>$row['password'],
            'id_estado'=>$row['id_estado'],
        ]);
    }
}
