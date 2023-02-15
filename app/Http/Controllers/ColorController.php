<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\color;
use Session;
use PDF;

use Maatwebsite\Excel\Excel;
use App\Exports\ColoresExport;
use App\Imports\ColoresImport;

class ColorController extends Controller
{
  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function ColorImport(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->excel->import(new ColoresImport, request()->file('importar') );
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function ColorExport(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return $this->excel->download(new ColoresExport, 'colores.xlsx');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function PDFColores(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $colores = color::all();
      $pdf = PDF::loadView('colores.pdf',compact('colores'));
      return $pdf -> stream('pdf_colores');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function cambiar_color(Request $request){
    $this->validate($request,[
      'color'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);

    $color = color::find($request->id_color);
    $color -> id_color = $request -> id_color;
    $color -> color = $request -> color;
    $color ->save();
    Session::flash('mensaje','Color modificado');
    return redirect()->route('colores');

  }

  public function editar_color($id_color){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $color = color::find($id_color);
      return view('colores.editar')->with('color',$color);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eliminar_color($id_color){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $color = color::withTrashed()->find($id_color)->forceDelete();
      Session::flash('eliminar','Color eliminado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function activar_color($id_color){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $color = color::withTrashed()->find($id_color)->restore();
      Session::flash('mensaje','Color activado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function desactivar_color($id_color){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $color = color::find($id_color)->delete();
      Session::flash('desactivar','Color desactivado');
      return redirect()->route('colores');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function guardar_color(Request $request){
    $this->validate($request,[
      'color'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);

    $color = new color;
    $color -> color = $request -> color;
    $color ->save();
    Session::flash('mensaje','Color guardado');
    return redirect()->route('colores');

  }

  public function agregar_color(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return view('colores.alta');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function colores(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $colores = color::withTrashed()->get();
      return view('colores.reportes')->with('colores',$colores);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }
}
