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
                  <h6 class="text-white text-capitalize ps-3">Colores</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="p-4">
                <form action="{{route('cambiar_color')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-1">
                        {{-- <label class="form-label">ID</label> --}}
                        <input type="text" class="form-control" name="id_color" value="{{$color->id_color}}">                      
                      </div>
                      @if($errors->first('id_color'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('id_color')}}</div>                          
                      @endif
                    </div>                    
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-1">
                        {{-- <label class="form-label">color</label> --}}
                        <input type="text" class="form-control" name="color" value="{{$color->color}}">                      
                      </div>
                      @if($errors->first('color'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('color')}}</div>                          
                      @endif
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-12">
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