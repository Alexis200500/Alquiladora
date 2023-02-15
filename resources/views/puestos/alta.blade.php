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
                  <h6 class="text-white text-capitalize ps-3">Puestos</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="p-4">
                  <form action="{{route('guardar_puesto')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-1">
                        <label class="form-label">Puesto</label>
                        <input type="text" class="form-control" name="puesto" value="{{old('puesto')}}">                      
                      </div>
                      @if($errors->first('puesto'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('puesto')}}</div>                          
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