<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Material</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($materiales as $material)
        <tr>
          <td>{{$material->id_material}}</td>
          <td>{{$material->material}}</td>
          <td>{{$material->created_at}}</td>
        </tr>
      @endforeach
    </tbody>
</table>