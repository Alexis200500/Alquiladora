<?php

namespace App\Http\Controllers;
use App\Models\materiales;
use Session;
use Illuminate\Http\Request;
use PDF;

use Maatwebsite\Excel\Excel;
use App\Exports\MaterialesExport;
use App\Imports\MaterialesImport;

class MaterialesController extends Controller
{
  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function ImportarMateriales(){
    $this->excel->import(new MaterialesImport, request()->file('importar'));
    return back();
  }

  public function ExcelMateriales(){
    return $this->excel->download(new MaterialesExport, 'materiales.xlsx');
  }

  public function PDFMateriales(){
    $materiales = materiales::all();
    $pdfmateriales = PDF::loadView('materiales/pdf',compact('materiales'));
    return $pdfmateriales -> stream('materiales.pdf');
  }

  public function editar_material(Request $request){
    $this->validate($request,[
      'material'=>'required|regex:/[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/'
    ]);

    $file = $request->file('imagen');
    if($file<>""){
      $fecha = date("Ymd_His_");
      $img = $file->getClientOriginalName();
      $img2 = $fecha.$img;
      \Storage::disk('local')->put($img2,\File::get($file));
    }
    $material = materiales::find($request->id_material);
    $material -> id_material = $request -> id_material;
    $material -> material = $request -> material;
    if($file<>""){
      $material -> imagen =$img2;
    }
    $material -> save();
    Session::flash('mensaje',"El material ha sido guardado");
    return redirect()->route('materiales');
  }

  public function detalle_material($id_material){
    $material = materiales::find($id_material);
    return view('materiales.editar')->with('material',$material);
  }

  public function eliminar_material($id_material){
    $material = materiales::withTrashed()->find($id_material)->forceDelete();
    Session::flash('eliminar','Material eliminado');
    return back();
  }

  public function activar_material($id_material){
    $material = materiales::withTrashed()->find($id_material)->restore();
    Session::flash('mensaje','Material activado');
    return back();
  }

  public function desactivar_material($id_material){
    $material = materiales::find($id_material)->delete();
    Session::flash('desactivar','Material desactivado');
    return back();
  }

  public function guardar_material(Request $request){
    $this->validate($request,[
      'material'=>'required|regex:/[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'imagen'=>'file:jpg,png,gif,webp,jpeg'
    ]);

    $file = $request->file('imagen');
    if($file<>""){
      $fecha = date("Ymd_His_");
      $img = $file->getClientOriginalName();
      $img2 = $fecha.$img;
      \Storage::disk('local')->put($img2,\File::get($file));
    }else{
      $img2 = 'sinfoto.jpg';
    }

    $material = new materiales;
    $material -> material = $request -> material;
    $material -> imagen =$img2;
    $material -> save();
    Session::flash('mensaje',"El material ha sido guardado");
    return redirect()->route('materiales');
  }

  public function agregar_material(){
    return view('materiales.alta');
  }

  public function materiales(){
    $materiales = materiales::withTrashed()->get();
    return view('materiales/reportes')
    ->with('materiales',$materiales);
  }
}
