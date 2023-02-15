<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\estado;
use App\Models\puesto;
use Session;
use Illuminate\Support\Facades\Hash;

use PDF;
use Maatwebsite\Excel\Excel;
use App\Exports\AdminsExport;
use App\Imports\AdminsImport;

class AdminController extends Controller
{
  private $excel;
  public function __construct(Excel $excel){
    $this->excel = $excel;
  }

  public function AdminsImport(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $this->excel->import(new AdminsImport, request()->file('importar'));
      Session::flash('mensaje','Excel importado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function AdminsExport(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return $this->excel->download(new AdminsExport, 'admins.xlsx');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function PDFadmins(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $admins = admin::join('estados','estados.id_estado','=','admins.id_estado')
      ->join('puestos','puestos.id_puesto','=','admins.id_puesto')
      ->get();

      $pdf = PDF::loadView('admins.pdf', compact('admins'))->setPaper('a4','landscape');
      return $pdf -> stream('PDFAdministadores');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function cambio_admin(Request $request){
    $this->validate($request,[
      'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'apellido_paterno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'apellido_materno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'edad'=>'required|regex:/^[0-9]{2}+$/',
      'direccion'=>'required',
      'telefono'=>'required|regex:/^[0-9]{10}+$/',
      'email'=>'required|email',
      'password'=>'required',
      'imagen'=>'image:jpg,jpeg,png,gif,webp'
    ]);
    
    $file = $request->file('imagen');
    if ($file<>""){
      $fecha = date("Ymd_His_");
      $img = $file->getClientOriginalName();
      $img2 = $fecha.$img;
      \Storage::disk('local')->put($img2,\File::get($file));
    }    

    $admin = admin::find($request->id_admin);
    $admin -> id_admin = $request ->id_admin;
    $admin -> nombre = $request ->nombre;
    $admin -> apellido_paterno = $request ->apellido_paterno;
    $admin -> apellido_materno = $request ->apellido_materno;
    $admin -> sexo = $request ->sexo;
    $admin -> edad = $request ->edad;
    if($file<>""){
      $admin -> imagen = $img2;
    }
    $admin -> direccion = $request ->direccion;
    $admin -> id_estado = $request ->id_estado;
    $admin -> telefono = $request ->telefono;
    $admin -> id_puesto = $request ->id_puesto;
    $admin -> email = $request ->email;
    $admin -> password = $request->password;

    // $admin -> password = Hash::make($request->password);

    $admin -> save();
    // dd($password);
    // return $admin;
    Session::flash('mensaje','El administrador ha sigo modificado');
    return redirect()->route('admins');    
  }

  public function editar_admin($id_admin){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $admin = admin::join('estados','estados.id_estado','=','admins.id_estado')
      ->join('puestos','puestos.id_puesto','=','admins.id_puesto')
      ->where('id_admin',$id_admin)->get();

      $estados = estado::all();
      $puestos = puesto::all();

      return view('admins.editar')
      ->with('admin',$admin[0])
      ->with('estados',$estados)
      ->with('puestos',$puestos);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function eliminar_admin($id_admin){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $admin = admin::withTrashed()->where('id_admin',$id_admin)->forceDelete();
      Session::flash('eliminar','Administrador eliminado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function activar_admin($id_admin){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $admin = admin::withTrashed()->where('id_admin',$id_admin)->restore();
      Session::flash('mensaje','Administrador activado');
      return back();
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function desactivar_admin($id_admin){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $admin = admin::find($id_admin)->delete();
      Session::flash('mensaje','Administrador desactivado');
      return redirect()->route('admins');
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function guardar_admin(Request $request){

    $this->validate($request,[
      'nombre'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'apellido_paterno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'apellido_materno'=>'required|regex:/^[A-Z][A-Z,a-z,á,é,í,ó,ú,ü,ñ, ]+$/',
      'edad'=>'required|regex:/^[0-9]{2}+$/',
      'direccion'=>'required',
      'telefono'=>'required|regex:/^[0-9]{10}+$/',
      'email'=>'required|email',
      'password'=>'required',
      'imagen'=>'image:jpg,jpeg,png,gif,webp'
    ]);
    
    $file = $request->file('imagen');
    if ($file<>""){
      $fecha = date("Ymd_His_");
      $img = $file->getClientOriginalName();
      $img2 = $fecha.$img;
      \Storage::disk('local')->put($img2,\File::get($file));
    }else{
      $img2 = 'sinfoto.jpg';
    }
    

    $admin = new admin;
    $admin -> nombre = $request ->nombre;
    $admin -> apellido_paterno = $request ->apellido_paterno;
    $admin -> apellido_materno = $request ->apellido_materno;
    $admin -> sexo = $request ->sexo;
    $admin -> edad = $request ->edad;
    $admin -> imagen = $img2;
    $admin -> direccion = $request ->direccion;
    $admin -> id_estado = $request ->id_estado;
    $admin -> telefono = $request ->telefono;
    $admin -> id_puesto = $request ->id_puesto;
    $admin -> email = $request ->email;

    // $admin -> password = $request ->password;

    $admin -> password = Hash::make($request->password);

    $admin -> save();

    Session::flash('mensaje','El administrador ha sigo creado');
    return redirect()->route('admins');

  }

  public function alta_admin(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $estados = estado::all();
      $puestos = puesto::all();
      return view('admins.alta')
      ->with('estados',$estados)
      ->with('puestos',$puestos);
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function admins(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      $admins = admin::withTrashed()
      ->join('estados','estados.id_estado','=','admins.id_estado')
      ->join('puestos','puestos.id_puesto','=','admins.id_puesto')
      ->select('admins.*','estados.estado','puestos.puesto')
      ->get();
      return view('admins.reportes')->with('admins',$admins);
      // return $admins;
    }else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }
}
