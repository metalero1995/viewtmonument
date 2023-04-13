<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\Monumento;
use App\Models\Comentarios;
use App\Models\interacciones;


use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;



class ApiPublicaController extends Controller
{
    public function mostrarEstados($id)
    {
        return Estado::where('id_pais', $id)->get();
       
    }
    public function mostrarCiudades($id)
    {
        return Ciudad::where('id_estado', $id)->get();
       
    }
    public function mostrarModalMonumentos($id)
    {
        return DB::select( DB::raw("SELECT * FROM monumentos INNER JOIN imagenes ON monumentos.id_monumento = imagenes.id_monumento INNER JOIN ciudades ON ciudades.id_ciudad = monumentos.id_ciudad INNER JOIN estados ON ciudades.id_estado = estados.id_estado INNER JOIN paises ON paises.id_pais = estados.id_pais WHERE tipo_imagen = 1 AND imagenes.id_monumento = $id
        ") );
       
    }
    public function mostrarComentariosMonumentos($id)
    {
        return DB::select( DB::raw("SELECT * FROM `comentarios` INNER JOIN monumentos ON comentarios.id_monumento = monumentos.id_monumento INNER JOIN users ON users.id = comentarios.id_usuario WHERE monumentos.id_monumento = $id LIMIT 1
        ") );
       
    }
    public function mostrarComentariosMonumentosV2($id,$limit)
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

    public function buscarInteraccion($id_monumento, $id_usuario)
    {
        return DB::select( DB::raw("SELECT * FROM `interacciones` INNER JOIN users ON users.id = interacciones.id_usuario INNER JOIN monumentos ON interacciones.id_monumentos = monumentos.id_monumento WHERE users.id = $id_usuario AND monumentos.id_monumento = $id_monumento; 
        ") );
    }

    //SELECT * FROM `interacciones` 
    public function crearInteraccion(Request $request,)
    {
        $data = new interacciones();
        $data->id_usuario = $request->userID;
        $data->id_monumentos = $request->idMonumento;
        $data->tipo_comentario = 0;
        $data->visto =0;
        $data->consultado = 0;
        $data->save();
        
    }

    public function actualizarInteraccion(Request $request,$id_interacciones)
    {
        $data = interacciones::find($id_interacciones);
        if($request->contadorConsulta != null){
            $data->consultado = $request->contadorConsulta;
        }
        if($request->tipo_comentario !=null){
            $data->tipo_comentario = $request->tipo_comentario;
        }
        $data->save();



    }



    public function mostrarRaiting(){
        return DB::select( DB::raw("SELECT * FROM `valoracion`") );
    }

    public function mostrarRaitingPersona($id_persona, $id_monumento){
        return DB::select( DB::raw("SELECT * FROM `interacciones` INNER JOIN users ON users.id = interacciones.id_usuario INNER JOIN valoracion ON interacciones.tipo_comentario = valoracion.tipo_comentario INNER JOIN monumentos ON interacciones.id_monumentos = monumentos.id_monumento WHERE interacciones.id_usuario = $id_persona AND interacciones.id_monumentos = $id_monumento") );
    }

    
}
