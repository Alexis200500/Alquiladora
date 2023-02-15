
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
<b>REPORTE DE EVENTOS</b>
<hr>
<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Evento</th>
      <th>Cantidad de personas</th>
      <th>Status</th>
      <th>Costo</th>
    </tr>
  </thead>
  @foreach ($detalles as $detalle)
    <tr>
      <td>{{$detalle->id_detalle_evento}}</td>
      <td>{{$detalle->nombre}} {{$detalle->apellido_paterno}} {{$detalle->apellido_materno}}</td>
      <td>{{$detalle->evento}}</td>
      <td>{{$detalle->cantidad_personas}}</td>
      <td>
        @if ($detalle->deleted_at)
          Rechazado    
        @else
          Aprobado            
        @endif
      </td>
      <td>{{$detalle->costo}}</td>
    </tr>
    @endforeacH   
  <tbody>
  </tbody>
</table>