
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
<b>REPORTE DE PUESTOS</b>
<hr>
<table>
  <thead>
    <tr>
      <td>ID</td>
      <td>Puesto</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($pdfpuestos as $puesto)
    <tr>
      <td>{{$puesto->id_puesto}}</td>        
      <td>{{$puesto->puesto}}</td>        
    </tr>
      @endforeach
  </tbody>
</table>