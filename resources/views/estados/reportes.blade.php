@extends('index')
@section('contenido')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Estados</h6>
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
                <a href="{{route('alta_estado')}}">
                  <button class="btn btn-success btn-sm">Agregar</button>
                </a>
                <a href="{{route('PDFestados')}}">
                  <button class="btn btn-danger btn-sm">PDF</button>
                </a>
                <a href="{{route('Estadosexcel')}}">
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Operaciones</th>
                </tr>
              </thead>
              <tbody>
              @forelse ($estados as $estado)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-0 text-sm">{{$estado->id_estado}}</h4>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-ms font-weight-bold mb-0">{{$estado->estado}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if($estado->deleted_at)
                      <a href="{{route('activar_estado',[$estado->id_estado])}}">
                        <button class="badge badge-sm bg-gradient-success">Activar</button>
                      </a>
                      <a href="{{route('eliminar_estado',[$estado->id_estado])}}">
                        <button class="badge badge-sm bg-gradient-danger">Eliminar</button>
                      </a>
                    @else
                    <a href="{{route('modificar_estado',[$estado->id_estado])}}">
                      <button class="badge badge-sm bg-gradient-info">
                        Editar
                      </button>
                    </a>
                    <a href="{{route('desactivar_estado',[$estado->id_estado])}}">
                      <button class="badge badge-sm bg-gradient-warning">
                        Desactivar                        
                      </button>
                    </a>
                    @endif
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
         
          <div class="container"> <br><br>
            <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
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




<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script type="text/javascript">
        $(document).ready(function () {
            (function ($) {
                $('#filtrar').keyup(function () {
                    var rex = new RegExp($(this).val(), 'i');
                    $('.buscar tr').hide();
                    $('.buscar tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
                })
            }(jQuery));
        });
        $("document").ready(function(){
          setTimeout(function(){
          $("#mensaje").remove();
        }, 2000 );
        });
      </script>