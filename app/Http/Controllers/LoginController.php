<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Session;

use Mail;
use DB;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

  public function index(){
    $sessionusuario = session('sessionusuario');
    if ($sessionusuario<>"") {
      return view('inicio');
    } else {
      Session::flash('mensaje','Necesita loguearse');
      return redirect()->route('login');
    }
  }

  public function login(){
    return view('login');
  }

  public function validar(Request $request){
    $this->validate($request,[
      'email'=>'required',
      'password'=>'required'
    ]);

    $consulta = admin::where('email',$request->email)->get();

    $cuanto = count($consulta);
    
    if($cuanto == 1 and Hash::check($request->password,$consulta[0]->password)){
      Session::put('sessionusuario',$consulta[0]->nombre .' '. $consulta[0]->apellido_paterno);
      Session::put('sessionid',$consulta[0]->id_cliente);
      return redirect()->route('index');
    }else{
      Session::flash('mensaje',"Correo o contraseña no son correctas");
      return back();
    }
  }

  public function cerrarsession(){
    Session::forget('sessionusuario');
    Session::forget('sessionid');
    Session::flush();
    Session::flash('mensaje','Session cerrada');
    return redirect()->route('login');
  }

  public function restaurar_vista(){
    return view('restaurar');
  }

  public function restaurar(Request $request){
    $this->validate($request,[
      'email'=>'required'
    ]);

    $email = $request->email;

    $res = admin::where('email',$email)
    ->get()
    ->count();

    // return $res;

    $asunto = "Tu contraseña ha sido modificada";

    if($res != null){
      $letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $nuevo = substr(str_shuffle($letras), 0,10);

      $nuevo2 = Hash::make($nuevo);

      DB::SELECT("UPDATE admins SET password = '$nuevo2' where email = '$email'");

      $datos = array('destinatario'=>$email, 'password'=> $nuevo, 'hash'=>$nuevo2);
      
      
      Mail::send('recupero',$datos, function($msj)
      use($asunto,$email,$nuevo){
        $msj -> from("al221811729@gmail.com","Alexis Morales");
        $msj -> to($email);
        $msj -> subject($asunto);
      }); 
      
      Session::flash('mensajecorrecto','Tu nueva contraseña ha sido actualizada, debes revisar tu correo');
      return redirect()->route('login');
      return $datos;
        
    }else{
      Session::flash('mensaje',"El correo no existe");
      return back();
    }

  }

  public function crear(){
    return view('crear');
  }

  public function guardar(Request $request){
    $this->validate($request,[
      'nombre'=>'required',
      'email'=>'required',
      'password'=>'required'
    ]);

    $admin = new admin;
    $admin -> nombre = $request ->nombre;
    $admin -> email = $request ->email;
    $admin -> password = Hash::make($request->password);

    $admin -> apellido_paterno = 'apellido paterno';
    $admin -> apellido_materno = 'apellido materno';
    $admin -> sexo = 'M';
    $admin -> edad = 00;
    $admin -> imagen = 'sinfoto.jpg';
    $admin -> direccion = 'direccion';
    $admin -> id_estado = 1;
    $admin -> telefono = 'numero telefonico';
    $admin -> id_puesto = 1;

    $admin -> save();

    Session::flash('mensajecorrecto','La cuenta ha sido creada');
    return redirect()->route('login');

  }

}