<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($estados as $estado)
        <tr>
          <td>{{$estado->id_estado}}</td>
          <td>{{$estado->estado}}</td>
          <td>{{$estado->created_at}}</td>
        </tr>
      @endforeach
    </tbody>
</table>