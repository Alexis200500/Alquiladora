<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Email</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($clientes as $cliente)
      <tr>
        <td>{{$cliente->id_cliente}}</td>
        <td>{{$cliente->nombre}} {{$cliente->apellido_paterno}} {{$cliente->apellido_materno}}</td>
        <td>{{$cliente->telefono}}</td>
        <td>{{$cliente->direccion}}</td>
        <td>{{$cliente->email}}</td>
        <td>{{$cliente->estado}}</td>
      </tr>        
    @endforeach
  </tbody>
</table>