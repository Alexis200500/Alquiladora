<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre completo</th>
      <th>Edad</th>
      <th>Sexo</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Estado</th>
      <th>Puesto</th>
      <th>Correo Electrónico</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($admins as $admin)
      <tr>
        <td>{{$admin->id_admin}}</td>
        <td>{{$admin->nombre}} {{$admin->apellido_paterno}} {{$admin->apellido_materno}}</td>
        <td>{{$admin->edad}}</td>
        <td>{{$admin->sexo}}</td>
        <td>{{$admin->telefono}}</td>
        <td>{{$admin->direccion}}</td>
        <td>{{$admin->estado}}</td>
        <td>{{$admin->puesto}}</td>
        <td>{{$admin->email}}</td>
      </tr>      
    @endforeach
  </tbody>
</table>