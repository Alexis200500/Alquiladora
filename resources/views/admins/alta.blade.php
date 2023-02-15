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
                  <h6 class="text-white text-capitalize ps-3">Administradores</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="p-4">
                  <form action="{{route('guardar_admin')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                      </div>
                      @if($errors->first('nombre'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('nombre')}}</div>    
                      @endif
                    </div>
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Apellido paterno</label>
                        <input type="text" class="form-control" name="apellido_paterno" value="{{old('apellido_paterno')}}">
                      </div>
                      @if($errors->first('apellido_paterno'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('apellido_paterno')}}</div>    
                      @endif
                    </div>                   
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Apellido materno</label>
                        <input type="text" class="form-control" name="apellido_materno" value="{{old('apellido_materno')}}">
                      </div>
                      @if($errors->first('apellido_materno'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('apellido_materno')}}</div>    
                      @endif
                    </div>                   
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label>Sexo:</label>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="radio" name="sexo" id="Masculino" value="M" checked>
                          <label class="custom-control-label" for="Masculino">Masculino</label>
                          <input class="form-check-input" type="radio" name="sexo" id="Femenino" value="F">
                          <label class="custom-control-label" for="Femenino">Femenino</label>
                        </div>                       
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Edad</label>
                        <input type="text" class="form-control" name="edad" value="{{old('edad')}}">
                      </div>
                      @if($errors->first('edad'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('edad')}}</div>    
                      @endif
                    </div>
                    <div class="col-md-1">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Imagen</label>
                      </div>                     
                    </div>
                    <div class="col-md-5">
                      <div class="input-group input-group-outline my-3">
                        <input type="file" class="form-control" name="imagen" value="{{old('imagen')}}">
                      </div>
                      @if($errors->first('imagen'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('imagen')}}</div>    
                      @endif
                    </div>
                    
                                       
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{old('direccion')}}">
                      </div>
                      @if($errors->first('direccion'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('direccion')}}</div>    
                      @endif
                    </div>
                    <div class="col-md-4">
                      <div class="input-group input-group-static mb-4">
                        <label for="id_estado" class="ms-0">Estado: </label>
                        <select class="form-control" name="id_estado" id="id_estado">
                          @foreach ($estados as $estado)
                            <option value="{{$estado->id_estado}}">{{$estado->estado}}</option>                            
                          @endforeach
                        </select>
                      </div>                      
                    </div>
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{old('telefono')}}">
                      </div>
                      @if($errors->first('telefono'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('telefono')}}</div>    
                      @endif
                    </div>                                                                   
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group input-group-static mb-4">
                        <label for="id_puesto" class="ms-0">Puesto: </label>
                        <select class="form-control" name="id_puesto" id="id_puesto">
                          @foreach ($puestos as $puesto)
                            <option value="{{$puesto->id_puesto}}">{{$puesto->puesto}}</option>                            
                          @endforeach
                        </select>
                      </div>                      
                    </div>
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="text" class="form-control" name="email" value="{{old('email')}}">
                      </div>
                      @if($errors->first('email'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('email')}}</div>    
                      @endif
                    </div> 
                    <div class="col-md-5">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="password" value="{{old('password')}}">
                      </div>
                      @if($errors->first('password'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('password')}}</div>    
                      @endif
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