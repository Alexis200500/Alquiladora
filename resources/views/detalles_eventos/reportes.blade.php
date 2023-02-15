@extends('index')
@section('contenido')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Clientes</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">

          {{-- BOTONES --}}
          <div class="container">
            <div class="row">
              <div class="col-sm">
                {{-- <span>1 of 3</span> --}}
              </div>
              <div class="col-sm">
                {{-- <span>2 of 3 (wider)</span> --}}
              </div>
              <div class="col-sm">
                <a href="{{route('alta_detalle')}}">
                  <button class="btn btn-success btn-sm">Agregar</button>
                </a>
                <a href="{{route('PDFdetalles')}}">
                  <button class="btn btn-danger btn-sm">PDF</button>
                </a>
                <a href="#">
                  <button class="btn btn-success btn-sm">Excel</button>
                </a>
              </div>
            </div>          
          </div>
          {{-- BOTONES --}}

          <div class="mensaje" name="mensaje" id="mensaje">
            @if(Session::has('mensaje'))              
              <div class="alert alert-success text-white" style="margin:10px" role="alert">
                <strong>{{Session::get('mensaje')}}</strong>
              </div>
            @endif

            @if(Session::has('desactivar'))              
              <div class="alert alert-warning text-white" style="margin:10px" role="alert">
                <strong>{{Session::get('desactivar')}}</strong>
              </div>
            @endif
            
            @if(Session::has('eliminar'))              
              <div class="alert alert-danger text-white" style="margin:10px" role="alert">
                <strong>{{Session::get('eliminar')}}</strong>
              </div>
            @endif
                  
          </div>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Evento</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Direccion</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Costo</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Operaciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($detalle as $detalle)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <p class="text-xs font-weight-bold mb-0">{{$detalle->id_detalle_evento}}</p>
                      </div>                      
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$detalle->nombre}} {{$detalle->apellido_paterno}} {{$detalle->apellido_materno}}</p>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">{{$detalle->evento}}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">{{$detalle->direccion}}</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">{{$detalle->costo}}</p>
                    </td>
                    <td class="align-middle text-center">
                      @if($detalle->deleted_at)
                        <a href="#">
                          <button class="badge badge-sm bg-gradient-danger">Cancelado</button>
                        </a>
                      @else
                        <a href="{{route('editar_detalle',[$detalle->id_detalle_evento])}}">
                          <button class="badge badge-sm bg-gradient-info">Editar</button>
                        </a>
                        <a href="{{route('cancelar_evento',[$detalle->id_detalle_evento])}}">
                          <button class="badge badge-sm bg-gradient-warning">Cancelar</button>
                        </a>
                      @endif
                    </td>  
                  </td>                  
                </tr>
                @empty
                <tr>
                  <td class="align-middle text-center text-sm" colspan="3">
                    <h6 class="mb-0 text-sm">No existen registros.</h6>
                  </td>
                </tr>                    
                @endforelse
                
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection