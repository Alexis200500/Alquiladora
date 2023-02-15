@extends('index')
@section('contenido')
<div class="table-responsive p-0">
  <table class="table align-items-center mb-0">
    <tbody>
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Evento</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="p-4">
                  <form action="{{route('cambio_detalle')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group input-group-outline my-3">
                        {{-- <label class="form-label">Dirección</label> --}}
                        <input type="text" class="form-control" name="id_detalle_evento" value="{{$detalle->id_detalle_evento}}">
                      </div>
                      @if($errors->first('id_detalle_evento'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('id_detalle_evento')}}</div>    
                      @endif
                    </div>   
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group input-group-static mb-4">
                        <label for="id_cliente" class="ms-0">Cliente: </label>
                        <select class="form-control" name="id_cliente" id="id_cliente">
                          <option value="{{$detalle->id_cliente}}">{{$detalle->nombre}} {{$detalle->apellido_paterno}} {{$detalle->apellido_materno}}</option>
                          @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id_cliente}}">{{$cliente->nombre}} {{$cliente->apellido_paterno}} {{$cliente->apellido_materno}}</option>                            
                          @endforeach
                        </select>
                      </div>                      
                    </div>
                    <div class="col-md-3">
                      <div class="input-group input-group-static mb-4">
                        <label for="id_evento" class="ms-0">Evento: </label>
                        <select class="form-control" name="id_evento" id="id_evento">
                          <option value="{{$detalle->id_evento}}">{{$detalle->evento}}</option>
                          @foreach ($eventos as $evento)
                            <option value="{{$evento->id_evento}}">{{$evento->evento}}</option>                            
                          @endforeach
                        </select>
                      </div>                      
                    </div>                   
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{$detalle->direccion}}">
                      </div>
                      @if($errors->first('direccion'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('direccion')}}</div>    
                      @endif
                    </div>                   
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group input-group-static mb-4">
                        <label for="id_estado" class="ms-0">Estado: </label>
                        <select class="form-control" name="id_estado" id="id_estado">
                          <option value="{{$detalle->id_estado}}">{{$detalle->estado}}</option>
                          @foreach ($estados as $estado)
                            <option value="{{$estado->id_estado}}">{{$estado->estado}}</option>                            
                          @endforeach
                        </select>
                      </div>                      
                    </div>  
                    <div class="col-md-2">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Fecha del evento</label>
                      </div>                     
                    </div>
                    <div class="col-md-2">
                      <div class="input-group input-group-outline my-3">
                        {{-- <label class="form-label">Fecha del evento</label> --}}
                        <input type="date" class="form-control" name="fecha_evento" value="{{$detalle->fecha_evento}}">
                      </div>
                      @if($errors->first('fecha_evento'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('fecha_evento')}}</div>    
                      @endif
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Costo</label>
                        <input type="text" class="form-control" name="costo" value="{{$detalle->costo}}">
                      </div>
                      @if($errors->first('costo'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('costo')}}</div>    
                      @endif
                    </div>                    
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Personas</label>
                        <input type="text" class="form-control" name="cantidad_personas" value="{{$detalle->cantidad_personas}}">
                      </div>
                      @if($errors->first('cantidad_personas'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('cantidad_personas')}}</div>    
                      @endif
                    </div>    
                    <div class="col-md-4">
                      <div class="input-group input-group-static mb-4">
                        <label for="id_admin" class="ms-0">Autorizo: </label>
                        <select class="form-control" name="id_admin" id="id_admin">
                          <option value="{{$detalle->id_admin}}">{{$detalle->n}} {{$detalle->ap}} {{$detalle->am}}</option>
                          @foreach ($admins as $admin)
                            <option value="{{$admin->id_admin}}">{{$admin->nombre}} {{$admin->apellido_paterno}} {{$admin->apellido_materno}}</option>                            
                          @endforeach
                        </select>
                      </div>                      
                    </div>                                                               
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="input-group input-group-outline is-valid my-1">                        
                      </div>
                    </div>                    
                    <div class="col-md-4">
                      <div class="input-group input-group-outline is-valid my-1">
                        <input type="submit" class="btn btn-success" value="Guardar">
                      </div>
                    </div>                    
                  </div>
                  </form>    
                </div>                                     
              </div>
            </div>
          </div>
        </div>
      </div>                                               
    </tbody>
  </table>
</div>
@endsection