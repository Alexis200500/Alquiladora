
<style>
  img{
    width: 200px;
    height: 200px;
    float: right;
    margin-top: -70px;
    margin-right: -50px;
  }
</style>

<img src="logo.jpg">
<p>Fecha: {{date('d-m-Y')}}</p>
<b>REPORTE DE ESTADOS</b>
<hr>
<table>
  <thead>
    <tr>
      <td>ID</td>
      <td>Material</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($materiales as $material)
    <tr>
      <td>{{$material->id_material}}</td>        
      <td>{{$material->material}}</td>        
    </tr>
      @endforeach
  </tbody>
</table>