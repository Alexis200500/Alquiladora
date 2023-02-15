@extends('index')
@section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Administradores</h6>
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
                <a href="{{route('alta_admin')}}">
                  <button class="btn btn-success btn-sm">Agregar</button>
                </a>
                <a href="{{route('PDFadmins')}}">
                  <button class="btn btn-danger btn-sm">PDF</button>
                </a>
                <a href="{{route('AdminsExport')}}">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Puesto</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estado</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Operaciones</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse ($admins as $admin)
                                    <tr>
                                      <td>
                                        <div class="d-flex px-2 py-1">
                                          <div>
                                            <img src="{{ asset('archivos/'.$admin->imagen) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                          </div>
                                          <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$admin->nombre}} {{$admin->apellido_paterno}} {{$admin->apellido_materno}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$admin->email}}</p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$admin->puesto}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$admin->telefono}}</p>
                                        <td class="align-middle text-center text-sm">
                                          <p class="text-xs text-secondary mb-0">{{$admin->estado}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                          @if($admin->deleted_at)
                                            <a href="{{route('activar_admin',[$admin->id_admin])}}">
                                              <button class="badge badge-sm bg-gradient-success">Activar</button>
                                            </a>
                                            <a href="{{route('eliminar_admin',[$admin->id_admin])}}">
                                              <button class="badge badge-sm bg-gradient-danger">Eliminar</button>
                                            </a>
                                          @else
                                            <a href="{{route('editar_admin',[$admin->id_admin])}}">
                                              <button class="badge badge-sm bg-gradient-info">
                                                Editar
                                              </button>
                                            </a>
                                            <a href="{{route('desactivar_admin',[$admin->id_admin])}}">
                                              <button class="badge badge-sm bg-gradient-warning">
                                                Desactivar                        
                                              </button>
                                            </a>
                                          @endif
                                        </td>
                                    </tr>
                                  @empty
                                    <tr>
                                      <td class="align-middle text-center text-sm" colspan="4">
                                        <h6 class="mb-0 text-sm">No existen registros.</h6>
                                      </td>
                                    </tr>
                                  @endforelse                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="container"> <br><br>
                          <form action="{{route('AdminsImport')}}" method="post" enctype="multipart/form-data">
                            @csrf
                          <div class="row">
                              <div class="col-sm"><h6>Importar Excel</h6></div>
                              <div class="col-sm">
                                <input type="file" name="importar" id="importar" class="btn">
                              </div>
                              <div class="col-sm"><input type="submit" value="Importar" class="btn btn-success"></div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
