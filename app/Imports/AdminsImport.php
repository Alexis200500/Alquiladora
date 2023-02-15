<?php

namespace App\Imports;

use App\Models\admin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class AdminsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new admin([
            'nombre'=>$row['nombre'],
            'apellido_paterno'=>$row['apellido_paterno'],
            'apellido_materno'=>$row['apellido_materno'],
            'edad'=>$row['edad'],
            'sexo'=>$row['sexo'],
            'telefono'=>$row['telefono'],
            'direccion'=>$row['direccion'],
            'id_estado'=>$row['id_estado'],
            'id_puesto'=>$row['id_puesto'],
            'imagen'=>'sinfoto.jpg',
            'email'=>$row['email'],
            'password'=>'123456789'
        ]);
    }
}
