<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detalle_evento;
use App\Models\cliente;
use App\Models\evento;
use App\Models\estado;
use App\Models\admin;

use Session;
use DB;
use PDF;

class DetalleEventoController extends Controller
{
  public function PDFdetalles(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $detalles = detalle_evento::withTrashed()
      ->join('clientes','clientes.id_cliente','=','detalle_eventos.id_cliente')
      ->join('eventos','eventos.id_evento','=','detalle_eventos.id_evento')
      ->join('estados','estados.id_estado','=','detalle_eventos.id_estado')
      ->join('admins','admins.id_admin','=','detalle_eventos.id_admin')
      ->select('detalle_eventos.*','clientes.nombre','clientes.apellido_paterno','clientes.apellido_materno','eventos.evento','estados.estado','admins.nombre as n',
      'admins.apellido_paterno as ap','admins.apellido_materno as am')
      ->get();

      $costo = DB::SELECT("SELECT SUM(costo) FROM detalle_eventos WHERE deleted_at IS NULL");
      // return $contar;

      $pdf = PDF::loadView('detalles_eventos.pdf',compact(['detalles']));
      return $pdf -> stream('Eventos.pdf');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function cambio_detalle(Request $request){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->validate($request,[
        'direccion'=>'required',
        'fecha_evento'=>'required|date',
        'costo'=>'required|numeric',
        'cantidad_personas'=>'required|numeric'
      ]);

      $detalle = detalle_evento::find($request->id_detalle_evento);
      $detalle -> id_detalle_evento = $request -> id_detalle_evento;
      $detalle -> id_cliente = $request -> id_cliente;
      $detalle -> id_evento = $request -> id_evento;
      $detalle -> direccion = $request -> direccion;
      $detalle -> id_estado = $request -> id_estado;
      $detalle -> fecha_evento = $request -> fecha_evento;
      $detalle -> costo = $request -> costo;
      $detalle -> cantidad_personas = $request -> cantidad_personas;
      $detalle -> id_admin = $request -> id_admin;
      $detalle -> save();

      Session::flash('mensaje','Evento modificado');
      return redirect()->route('detalle_eventos');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function editar_detalle($id_detalle_evento){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      /* $detalle = detalle_evento::join('clientes','clientes.id_cliente','=','detalle_eventos.id_cliente')
      ->join('eventos','eventos.id_evento','=','detalle_eventos.id_evento')
      ->join('estados','estados.id_estado','=','detalle_eventos.id_estado')
      ->join('admins','admins.id_admin','=','detalle_eventos.id_admin')
      ->select('detalle_eventos.*','clientes.nombre','clientes.apellido_paterno','clientes.apellido_materno','eventos.evento','estados.estado','admins.nombre as n',
      'admins.apellido_paterno as ap','admins.apellido_materno as am'
      )
      ->get(); */

      $detalle = DB::SELECT("SELECT detalle_eventos.id_detalle_evento,detalle_eventos.id_cliente,clientes.nombre, clientes.apellido_paterno, clientes.apellido_materno,detalle_eventos.id_evento,eventos.evento,detalle_eventos.direccion,detalle_eventos.id_estado,estados.estado,detalle_eventos.fecha_evento,detalle_eventos.costo,detalle_eventos.cantidad_personas,detalle_eventos.id_admin,admins.nombre AS n, admins.apellido_paterno AS ap, admins.apellido_materno AS am FROM detalle_eventos INNER JOIN clientes ON clientes.id_cliente = detalle_eventos.id_cliente INNER JOIN eventos ON eventos.id_evento = detalle_eventos.id_evento INNER JOIN estados ON estados.id_estado = detalle_eventos.id_estado INNER JOIN admins ON admins.id_admin = detalle_eventos.id_admin WHERE id_detalle_evento = $id_detalle_evento");

      $clientes = cliente::all();
      $eventos = evento::all();
      $estados= estado::all();
      $admins= admin::all();

      return view('detalles_eventos.editar')->with('detalle',$detalle[0])
      ->with('clientes',$clientes)
      ->with('estados',$estados)
      ->with('admins',$admins)
      ->with('eventos',$eventos);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function cancelar_evento($id_detalle_evento){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $detalle = detalle_evento::find($id_detalle_evento)->delete();
      Session::flash('eliminar','Evento cancelado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function guardar_detalle(Request $request){
    
    $this->validate($request,[
      'direccion'=>'required',
      'fecha_evento'=>'required|date',
      'costo'=>'required|numeric',
      'cantidad_personas'=>'required|numeric'
    ]);

    $detalle = new detalle_evento;
    $detalle -> id_cliente = $request -> id_cliente;
    $detalle -> id_evento = $request -> id_evento;
    $detalle -> direccion = $request -> direccion;
    $detalle -> id_estado = $request -> id_estado;
    $detalle -> fecha_evento = $request -> fecha_evento;
    $detalle -> costo = $request -> costo;
    $detalle -> cantidad_personas = $request -> cantidad_personas;
    $detalle -> id_admin = $request -> id_admin;
    $detalle -> save();

    Session::flash('mensaje','Evento creado');
    return redirect()->route('detalle_eventos');

  }

  public function alta_detalle(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $clientes = cliente::all();
      $eventos = evento::all();
      $estados= estado::all();
      $admins= admin::all();
      return view('detalles_eventos.alta')
      ->with('clientes',$clientes)
      ->with('estados',$estados)
      ->with('admins',$admins)
      ->with('eventos',$eventos);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function detalle_eventos(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $detalle = detalle_evento::withTrashed()
      ->join('clientes','clientes.id_cliente','=','detalle_eventos.id_cliente')
      ->join('eventos','eventos.id_evento','=','detalle_eventos.id_evento')
      ->select('detalle_eventos.*','clientes.nombre','clientes.apellido_paterno','clientes.apellido_materno','eventos.evento')
      ->get();
      return view('detalles_eventos.reportes')->with('detalle',$detalle);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }
}
