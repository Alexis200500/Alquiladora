<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\estado;
use Session;
use PDF;
use Illuminate\Support\Facades\Hash;


use App\Exports\ClientesExport;
use App\Imports\ClientesImport;
use Maatwebsite\Excel\Excel;

class ClienteController extends Controller
{

  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function ClientesImportar(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->excel->import(new ClientesImport, request()->file('importar'));
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function ClientesExcelExportar(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return $this->excel->download(new ClientesExport, 'clientes.xlsx');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function PDFClientes(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $pdfclientes = cliente::join('estados','estados.id_estado','=','clientes.id_estado')
      ->select('clientes.*','estados.estado')
      ->get();
      $pdf = PDF::loadView('clientes.pdf',compact('pdfclientes'));
      return $pdf -> stream('pdf_clientes');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function modificar_cliente(Request $request){
    
    $this->validate($request,[
      'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ,Ñ, ]+$/',
      'apellido_paterno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ,Ñ, ]+$/',
      'apellido_materno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ,Ñ, ]+$/',
      'edad'=>'required|regex:/^[0-9]{2}+$/',
      'direccion'=>'required',
      'telefono'=>'required|regex:/^[0-9]{10}+$/',
      'email'=>'required|email',
      'password'=>'required',
      'imagen'=>'image:jpg, webp, png, gif,jpeg,svg'
    ]);

    $file = $request->file('imagen');
    if($file<>"") {
      $fecha = date("Ymd_His_");
      $img = $file->getClientOriginalName();
      $img2 = $fecha.$img;
      \Storage::disk('local')->put($img2,\File::get($file));
    }
    

    $cliente = cliente::find($request->id_cliente);
    $cliente -> id_cliente = $request -> id_cliente;
    $cliente -> nombre = $request -> nombre;
    $cliente -> apellido_paterno = $request -> apellido_paterno;
    $cliente -> apellido_materno = $request -> apellido_materno;
    $cliente -> sexo = $request -> sexo;
    $cliente -> edad = $request -> edad;
    if($file<>""){
      $cliente -> imagen = $img2;
    }
    
    $cliente -> direccion = $request -> direccion;
    $cliente -> id_estado = $request -> id_estado;
    $cliente -> telefono = $request -> telefono;
    $cliente -> email = $request -> email;
    $cliente -> password = $request -> password;
    $cliente->save();
    
    Session::flash('mensaje','El cliente ha sido modificado');
    return redirect()->route('clientes');

  }

  public function editar_cliente($id_cliente){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $cliente = cliente::where('id_cliente',$id_cliente)
      ->join('estados','estados.id_estado','=','clientes.id_estado')
      ->select('clientes.*','estados.estado')
      ->get();
      // dd($cliente);

      $estados = estado::all();

      return view('clientes.editar')
      ->with('cliente',$cliente[0])
      ->with('estados',$estados);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eliminar_cliente($id_cliente){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $cliente = cliente::withTrashed()->where('id_cliente',$id_cliente)->forceDelete();
      Session::flash('mensaje','Cliente eliminado');
      return redirect()->route('clientes');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function activar_cliente($id_cliente){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $cliente = cliente::withTrashed()->where('id_cliente',$id_cliente)->restore();
      Session::flash('mensaje','Cliente activado');
      return redirect()->route('clientes');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function desactivar_cliente($id_cliente){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $cliente = cliente::find($id_cliente)->delete();
      Session::flash('desactivar','Cliente desactivado');
      return redirect()->route('clientes');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }
  
  public function guardar_cliente(Request $request){

    $this->validate($request,[
      'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ,Ñ, ]+$/',
      'apellido_paterno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ,Ñ, ]+$/',
      'apellido_materno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ,Ñ, ]+$/',
      'edad'=>'required|regex:/^[0-9]{2}+$/',
      'direccion'=>'required',
      'telefono'=>'required|regex:/^[0-9]{10}+$/',
      'email'=>'required|email',
      'password'=>'required',
      'imagen'=>'image:jpg, webp, png, gif,jpeg,svg'
    ]);

    $file = $request->file('imagen');
    if($file<>"") {
      $fecha = date("Ymd_His_");
      $img = $file->getClientOriginalName();
      $img2 = $fecha.$img;
      \Storage::disk('local')->put($img2,\File::get($file));
    } else {
      $img2 = 'sinfoto.jpg';
    }
    

    $cliente = new cliente;
    $cliente -> nombre = $request -> nombre;
    $cliente -> apellido_paterno = $request -> apellido_paterno;
    $cliente -> apellido_materno = $request -> apellido_materno;
    $cliente -> sexo = $request -> sexo;
    $cliente -> edad = $request -> edad;
    $cliente -> imagen = $img2;
    $cliente -> direccion = $request -> direccion;
    $cliente -> id_estado = $request -> id_estado;
    $cliente -> telefono = $request -> telefono;
    $cliente -> email = $request -> email;
    // $cliente -> password = $request -> password;
    $cliente -> password = Hash::make($request->password);

    $cliente->save();
    
    Session::flash('mensaje','El cliente ha sido guardado');
    return redirect()->route('clientes');

  }

  public function agregar_cliente(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estados = estado::all();
      return view('clientes.alta')->with('estados',$estados);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function clientes(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $clientes = cliente::withTrashed()
      ->join('estados','estados.id_estado','=','clientes.id_estado')
      ->select('clientes.*','estados.estado')
      ->get();
      return view('clientes.reportes')->with('clientes',$clientes);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }
}
