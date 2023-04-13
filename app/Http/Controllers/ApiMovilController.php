<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Monumento;
use App\Models\Comentarios;

class ApiMovilController extends Controller
{
    public function mostrarModalMonumentos($id)
    {
        return DB::select( DB::raw("SELECT * FROM monumentos INNER JOIN imagenes ON monumentos.id_monumento = imagenes.id_monumento INNER JOIN ciudades ON ciudades.id_ciudad = monumentos.id_ciudad INNER JOIN estados ON ciudades.id_estado = estados.id_estado INNER JOIN paises ON paises.id_pais = estados.id_pais WHERE tipo_imagen = 1 AND imagenes.id_monumento = $id
        ") );
       
    }
    public function mostrarComentariosMonumentos($id,$limit)
    {
        return DB::select( DB::raw("SELECT * FROM `comentarios` INNER JOIN monumentos ON comentarios.id_monumento = monumentos.id_monumento INNER JOIN users ON users.id = comentarios.id_usuario WHERE monumentos.id_monumento = $id ORDER BY comentarios.id_comentario DESC  LIMIT $limit
        ") );
       
    }
    public function totalComentariosMonumentos($id)
    {
        return DB::select( DB::raw("SELECT COUNT(id_comentario) AS total FROM `comentarios` INNER JOIN monumentos ON comentarios.id_monumento = monumentos.id_monumento INNER JOIN users ON users.id = comentarios.id_usuario  WHERE monumentos.id_monumento = $id
        ") );
    }
    public function guardarComentario(Request $request)
    {
        $data = new Comentarios();
        $data->id_usuario = $request->idPersona;
        $data->id_monumento = $request->idMonumentoGuardado;
        $data->descripcion_comentario = $request->comentarioPersona;

        $data->save();
    }
    //registro de usuarios
    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'profile' => ['required', 'numeric'],
            'age'=>['required','numeric','max:120','min:1'],
            'ciudad'=>['required']
        ]);

        //created user
        $user = User::create([
            'PerfilID' => $request->profile,
            'ciudad' => $request->ciudad,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'age' => $request->age,
            'password' => bcrypt($attrs['password'])
        ]);

        //return user & tokens in response
        return response ([
            'user'=>$user,
            'token'=>$user->createToken('secret')->plainTextToken
        ], 200);
    }

    //login user
    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'profile' => ['required', 'numeric'],
            'age'=>['required','numeric','max:120','min:1'],
            'ciudad'=>['required']
        ]);

        //attempt login
        if (!Auth::attempt($attrs))
        {
            return response([
                'message'=> 'Credencial Invalido'
            ], 403);
        }

        //return user & tokens in response
        return response ([
            'user'=>auth()->user(),
            'token'=> auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    //logout user
    public function logout()
    {
        auth()->user()->tokens()-dekete();
        return response([
            'message'=> 'Haz finalizado la seccion satisfactoriamente'
        ], 200);
    }
    //get user details
    public function user()
    {
        return response([
            'user'=> auth()->user()
        ],200);
    }
}
