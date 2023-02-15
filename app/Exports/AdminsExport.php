<?php

namespace App\Exports;

use App\Models\admin;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminsExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function view(): View
    {
        return view('admins.excel',['admins'=>
            admin::join('estados','estados.id_estado','=','admins.id_estado')
            ->join('puestos','puestos.id_puesto','=','admins.id_puesto')
            ->select('admins.*','estados.estado','puestos.puesto')
            ->get()
        ]);
    }
}
