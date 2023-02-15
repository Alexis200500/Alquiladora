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
<p>REPORTE DE CLIENTES</p>
<hr>
<table border="1">
  <thead>
    <tr>
      <th>Nombre completo</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pdfclientes as $cliente)
      <tr>
        <td>{{$cliente->nombre}} {{$cliente->apellido_paterno}} {{$cliente->apellido_materno}}</td>
        <td>{{$cliente->telefono}}</td>
        <td>{{$cliente->direccion}}</td>
        <td>{{$cliente->estado}}</td>
      </tr>        
    @endforeach
  </tbody>
</table>