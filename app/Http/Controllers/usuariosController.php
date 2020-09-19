<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Oficinas;
use App\Bitacora;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class usuariosController extends Controller
{
    public function list(){
        $usuarios = User::get();
        return view('usuarios/ver_usuarios',compact('usuarios'));
    }

    public function create(){
        $oficinas = Oficinas::get();
        return view('usuarios/nuevo_usuario',compact('oficinas'));
    }

    public function save(Request $request){
        
        $usuario = new User;

        //validaciones campos formulario
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required|unique:users',
            'email'=>'required|unique:users',
            'imagen'=>'image|mimes:jpg,png,jpeg,svg|Max:2048',
            'password'=>'required',
            'password_confirm'=>'required_with:password|same:password',
        ],[
            'name.required'=>'Nombre personal requerido',
            'username.required'=>'Nombre usuario requerido',
            'username.unique'=>'Cédula duplicada, por favor ingrese otro número de cédula.',
            'email.required'=>'Correo requerido',
            'email.unique'=>'Correo duplicado, este correo ya se encuentra en uso.',
            'imagen.image'=>'El archivo debe ser una imagen',
            'imagen.mimes'=>'El formato de la imagen debe ser: jpg,png,jpeg,svg',
            'imagen.Max'=>'La imagen no dbe superar los 2MB',
            'password.required'=>'Contraseña requerida',
            'password_confirm.same'=>'Las contraseñas no coinciden'
        ]);

        //tratamiento de archivo imagen
        if($request->imagen != null){
            $filename = $request->username.'.'.$request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path('images/profiles'),$filename);            
            $usuario->imagen = $filename;
        }

        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->email = $request->email;        
        $usuario->estado = $request->estado;
        $usuario->rol = $request->rol;
        $usuario->oficina_id = $request->oficina_id;
        $usuario->password = bcrypt($request->password);      
        $usuario->save();

        // bitacora
        
        $this->bitacoraUsuario(1,$request->name);

        return redirect()->action('usuariosController@list')->with('status','Usuario registrado de manera satisfactoria');
    }

    public function edit($id){

        $usuario = User::find($id);
        $oficinas = Oficinas::get();
        return view('usuarios/editar_usuario',compact('usuario','oficinas'));
    }

    public function update(Request $request){
        
        $usuario = User::find($request->id);
        
        //validaciones campos formulario
        $this->validate($request,[
            'name'=>'required',
            'username'=>'unique:users',
            'email'=>'required',
            'imagen'=>'image|mimes:jpg,png,jpeg,svg|Max:2048',            
            'password_confirm'=>'same:password',
        ],[
            'name.required'=>'Nombre personal requerido.',
            // 'username.required'=>'Nombre usuario requerido',
            'username.unique'=>'Cédula duplicada, por favor ingrese otro número de cédula.',
            'email.required'=>'Correo requerido.',            
            'imagen.image'=>'El archivo debe ser una imagen',
            'imagen.mimes'=>'El formato de la imagen debe ser: jpg,png,jpeg,svg.',
            'imagen.Max'=>'La imagen no debe superar los 2MB.',            
            'password_confirm.required'=>'Se requiere la confirmación de la contraseña.',
            'password_confirm.same'=>'la contraseña y la confirmación deben ser iguales',
        ]);
              

        //valido archivo
        if($request->imagen != null){
            $filename = $usuario->username.'.'.$request->imagen->getClientOriginalExtension();
            $request->imagen->move(public_path('images/profiles'),$filename);            
            $usuario->imagen = $filename;
        }

        //valido contraseña
        if($request->password != null && $request->password_confirm != null){
            $usuario->password = bcrypt($request->password);            
        }

        $usuario->name = $request->name;
        
        if($request->estado != null){
            $usuario->estado = $request->estado;
        }        
        
        if ($request->rol != null){
            $usuario->rol = $request->rol;
        }
        $usuario->email = $request->email;
        
        if($request->oficina_id != null){
            $usuario->oficina_id = $request->oficina_id;
        }

        $usuario->save();

        $this->bitacoraUsuario(2,$usuario->name);

        if(Auth::user()->rol < 2){
            return redirect()->back()->with('status','Usuario actualizado satisfactoriamente!');
        }else{
            return redirect()->action('usuariosController@list')->with('status','Usuario actualizado satisfactoriamente!');
        }

        
    }

    public function activate($id){

        $usuario = User::find($id);
        
        //realizo validación de estado  
        if($usuario->estado == 1){
            $usuario->estado = 0;
            $this->bitacoraUsuario(3,$usuario->name);
        }else{
            $usuario->estado = 1;
            $this->bitacoraUsuario(4,$usuario->name);
        }
            $usuario->save();
        //$usuario->delete();
        return redirect()->action('usuariosController@list')->with('status','Cambio estado usaurio satisfactoriamente!');
    }

    public function unauthorized(){
        return view('errors.403');
    }

    public function bitacoraUsuario($bandera, $user){
        $bitacora = new Bitacora;
        $usuario = Auth::user();

        $bitacora->usuario_id = $usuario->id;
        $bitacora->ip = \Request::ip();

        if($bandera==1){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha creado al usuario <b>'.$user.'</b> de forma correcta.';
        }elseif($bandera==2){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha actualizado datos del usuario <b>'.$user.'</b> de forma correcta.';
        }elseif($bandera==3){
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha inactivado al usuario <b>'.$user.'</b> de forma correcta.';
        }else{
            $bitacora->accion = 'El usuario <b>'.$usuario->name.'</b> ha activado al usuario <b>'.$user.'</b> de forma correcta.';
        }

        $bitacora->save();
    }
}
