<table>
  <thead>
      <tr>
          <th>ID</th>
          <th>Estado</th>
          <th>Fecha de creación</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($puestos as $puesto)
      <tr>
        <td>{{$puesto->id_puesto}}</td>
        <td>{{$puesto->puesto}}</td>
        <td>{{$puesto->created_at}}</td>
      </tr>
    @endforeach
  </tbody>
</table>