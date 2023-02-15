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
                  <h6 class="text-white text-capitalize ps-3">Materiales</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="p-4">
                <form action="{{route('editar_material')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-1">
                        {{-- <label class="form-label">ID</label> --}}
                        <input type="text" class="form-control" name="id_material" value="{{$material->id_material}}">                      
                      </div>
                      @if($errors->first('id_material'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('id_material')}}</div>                          
                      @endif
                    </div>                    
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-1">
                        {{-- <label class="form-label">Material</label> --}}
                        <input type="text" class="form-control" name="material" value="{{$material->material}}">                      
                      </div>
                      @if($errors->first('material'))
                        <div class="text-xs text-danger mb-0">{{$errors->first('material')}}</div>                          
                      @endif
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group input-group-outline my-1"></div>                     
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-outline my-1">                      
                        <img src="{{asset('archivos/'.$material->imagen)}}" alt="{{$material->imagen}}" >
                      </div>                     
                    </div>
                    <div class="col-md-3">
                      <div class="input-group input-group-outline my-1"></div>                       
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="input-group input-group-outline my-1"></div>                     
                    </div>
                    <div class="col-md-4">
                      <div class="input-group input-group-outline my-1">                      
                        <input type="file" class="form-control" name="imagen" value="{{old('imagen')}}">                      
                      </div>
                        @if($errors->first('imagen'))
                          <div class="text-xs text-danger mb-0">{{$errors->first('imagen')}}</div>                          
                        @endif
                    </div>
                    <div class="col-md-3">
                      <div class="input-group input-group-outline my-1"></div>                       
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