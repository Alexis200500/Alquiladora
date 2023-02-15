<?php

namespace App\Exports;

use App\Models\cliente;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClientesExport implements FromView, ShouldAutoSize
{

    use Exportable;

    public function view(): View
    {
        return view('clientes.export',['clientes'=>cliente::join('estados','estados.id_estado','=','clientes.id_estado')
            ->select('clientes.*','estados.estado')
            ->get()
        ]);
    }
}
