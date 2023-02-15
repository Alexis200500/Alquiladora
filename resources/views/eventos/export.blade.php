<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Evento</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($eventos as $evento)
        <tr>
          <td>{{$evento->id_evento}}</td>
          <td>{{$evento->evento}}</td>
          <td>{{$evento->created_at}}</td>
        </tr>
      @endforeach
    </tbody>
</table>