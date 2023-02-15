<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($colores as $color)
        <tr>
          <td>{{$color->id_color}}</td>
          <td>{{$color->color}}</td>
          <td>{{$color->created_at}}</td>
        </tr>
      @endforeach
    </tbody>
</table>