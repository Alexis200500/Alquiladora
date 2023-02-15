<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\estado;
use Session;
use PDF;
use App\Exports\EstadosExport;
use App\Imports\EstadosImport;
use Maatwebsite\Excel\Excel;

class EstadoController extends Controller
{

  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function import(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->excel->import(new EstadosImport, request()->file('importar'));
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function Estadosexcel(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return $this->excel->download(new EstadosExport, 'estados.xlsx');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function PDFestados(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $pdfestados = estado::orderBy('estado','asc')->get();
      $pdf = PDF::loadView('estados.pdf',compact('pdfestados')); //->setPaper('a4','landscape')Horizontal en landscape
      return $pdf -> stream('pdf_estados.pdf');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function editar_estado(Request $request){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->validate($request,[
        'estado'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
      ]);

      $estado = estado::find($request->id_estado);
      $estado -> id_estado = $request ->id_estado;
      $estado -> estado = $request ->estado;
      $estado -> save();
      Session::flash('mensaje','Estado modificado');
      return redirect()->route('estados');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }      
  }

  public function modificar_estado($id_estado){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estado = estado::find($id_estado);
      return view('estados.editar')
      ->with('estado',$estado);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eliminar_estado($id_estado){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estado = estado::withTrashed()->find($id_estado)->forceDelete();
      Session::flash('eliminar','Estado eliminado');
      return redirect()->route('estados');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function activar_estado($id_estado){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estado = estado::withTrashed()->find($id_estado)->restore();
      Session::flash('mensaje','Estado activado');
      return redirect()->route('estados');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function desactivar_estado($id_estado){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estado = estado::find($id_estado)->delete();
      Session::flash('desactivar','Estado desactivado');
      return redirect()->route('estados');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  
  }

  public function guardar_estado(Request $request){

    $this->validate($request,[
      'estado'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);

    $estado = new estado;
    $estado -> estado = $request ->estado;
    $estado -> save();
    Session::flash('mensaje','Estado guardado');
    return redirect()->route('estados');
  }

  public function alta_estado(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return view('estados.alta');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function estados(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estados = estado::withTrashed()->get();
      return view('estados/reportes')->with('estados',$estados);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }      
  }

}
