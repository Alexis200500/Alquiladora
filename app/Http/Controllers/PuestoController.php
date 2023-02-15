<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\puesto;
use Session;
use PDF;

use Maatwebsite\Excel\Excel;
use App\Exports\PuestosExport;
use App\Imports\Puestosimportar;

class PuestoController extends Controller
{

  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function Puestosimportar(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->excel->import(new Puestosimportar, request()->file('importar'));
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function PuestosExcel(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return $this->excel->download(new PuestosExport, 'puestos.xlsx');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function PDFPuestos(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $pdfpuestos = puesto::orderBy('puesto','asc')->get();
      $pdf = PDF::loadView('puestos.pdf',compact('pdfpuestos'));
      return $pdf->stream('pdf_puestos.pdf');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function modificar_puesto(Request $request){
    $this->validate($request,[
      'puesto'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);
    $puesto = puesto::find($request->id_puesto);
    $puesto -> id_puesto = $request -> id_puesto;
    $puesto -> puesto = $request -> puesto;
    $puesto -> save();
    
    Session::flash('mensaje',"El puesto sido modificado");
    return redirect()->route('puestos');
  }

  public function editar_puesto($id_puesto){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $puesto = puesto::where('id_puesto',$id_puesto)->get();
      return view('puestos.editar')->with('puesto',$puesto[0]);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eliminar_puesto($id_puesto){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $puesto = puesto::where('id_puesto',$id_puesto)->forceDelete();
      Session::flash('eliminar','Puesto eliminado');
      return redirect()->route('puestos');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function activar_puesto($id_puesto){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $puesto = puesto::withTrashed()->find($id_puesto)->restore();
      Session::flash('mensaje','Puesto activado');
      return redirect()->route('puestos');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function desactivar_puesto($id_puesto){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $puesto = puesto::find($id_puesto)->delete();
      Session::flash('desactivar','Puesto desactivado');
      return redirect()->route('puestos');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function guardar_puesto(Request $request){
    $this->validate($request,[
      'puesto'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);
    $puesto = new puesto;
    $puesto -> puesto = $request -> puesto;
    $puesto -> save();
    
    Session::flash('mensaje',"El puesto $request->puesto ha sido creado");
    return redirect()->route('puestos');
    
  }

  public function alta_puesto(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return view('puestos.alta');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function puestos(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $puestos = puesto::withTrashed()->get();
      return view('puestos.reportes')->with('puestos',$puestos);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

}
