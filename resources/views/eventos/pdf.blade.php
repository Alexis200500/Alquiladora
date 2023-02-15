
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
      <td>Estado</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($eventos as $evento)
    <tr>
      <td>{{$evento->id_evento}}</td>        
      <td>{{$evento->evento}}</td>        
    </tr>
      @endforeach
  </tbody>
</table>