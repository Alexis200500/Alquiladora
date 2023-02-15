<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\evento;
use Session;
use DB;
use PDF;

use Maatwebsite\Excel\Excel;
use App\Exports\EventosExport;
use App\Imports\EventosImport;

class EventoController extends Controller
{
  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function EventosImportar(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->excel->import(new EventosImport, request()->file('importar'));
      Session::flash('mensaje','Excel Importado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function Eventoexportar(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return $this->excel->download(new EventosExport, 'eventos.xlsx');   
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    } 
  }

  public function PDFEventos(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $eventos = evento::all();
      $pdf = PDF::loadView('eventos.pdf',compact('eventos'));
      return $pdf -> stream('eventos.pdf');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function cambio_evento(Request $request){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->validate($request,[
        'evento'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
      ]);

      $evento = evento::find($request->id_evento);
      $evento -> id_evento = $request -> id_evento;
      $evento -> evento = $request -> evento;
      $evento -> save();

      Session::flash('mensaje','Evento modificado');
      return redirect()->route('eventos');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function editar_evento($id_evento){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $evento = DB::SELECT("SELECT * FROM eventos where id_evento = $id_evento");
      // return $evento;
      return view('eventos.editar')->with('evento',$evento[0]);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eliminar_evento($id_evento){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $evento = evento::withTrashed()->find($id_evento)->forceDelete();
      Session::flash('eliminar','Evento eliminado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function activar_evento($id_evento){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $evento = evento::withTrashed()->find($id_evento)->restore();
      Session::flash('mensaje','Evento activado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function desactivar_evento($id_evento){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $evento = evento::find($id_evento)->delete();
      Session::flash('desactivar','Evento desactivado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }  
  }

  public function guardar_evento(Request $request){
    $this->validate($request,[
      'evento'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);

    $evento = new evento;
    $evento -> evento = $request -> evento;
    $evento -> save();

    Session::flash('mensaje','Evento guardado');
    return redirect()->route('eventos');
  }

  public function alta_evento(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return view('eventos.alta');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eventos(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $eventos = evento::withTrashed()->get();
      return view('eventos.reportes')->with('eventos',$eventos);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }
}
