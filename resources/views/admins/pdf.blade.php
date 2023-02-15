<style>
  img{
    width: 200px;
    height: 180px;
    float: right;
    margin-top: -70px;
    margin-left: -90px;
  }
  
</style>

<img src="logo.jpg"><br>
<p>Fecha: {{date('d-m-Y')}}</p>
<p>REPORTE DE ADMINISTRADORES</p>
<hr>
<table border="1">
  <thead>
    <tr>
      <th>Nombre completo</th>
      <th>Teléfono</th>
      <th>Correo eletrónico</th>
      <th>Dirección</th>
      <th>Estado</th>
      <th>Puesto</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($admins as $admin)
    <tr>
      <td>{{$admin->nombre}} {{$admin->apellido_paterno}} {{$admin->apellido_materno}}</td>
      <td>{{$admin->telefono}}</td>    
      <td>{{$admin->email}}</td>    
      <td>{{$admin->direccion}}</td>    
      <td>{{$admin->estado}}</td>    
      <td>{{$admin->puesto}}</td>    
    </tr>
    @endforeach
  </tbody>
</table>