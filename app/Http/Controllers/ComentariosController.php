<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentarios;
use App\Models\Monumento;
use App\Models\User;
use App\Models\Valoracion;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Comentarios::all();
        return view('comentarios.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataMonumentos = Monumento::all();
        $dataUser = User::all();
        $data = Comentarios::all();
        $dataValoracion = Valoracion::all();
        return view('comentarios.create')->with(compact('data','dataValoracion', 'dataUser', 'dataMonumentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new Comentarios();
        $data->id_usuario = $request->id_usuario;
        $data->id_monumento = $request->id_monumento;
        $data->descripcion_comentario = $request->descripcion_comentario;

        $data->save();

        return redirect()->route('comentarios.index')->with('success', 'Comentario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd(Monumento::all());
        $dataMonumentos = Monumento::all();
        $dataUser = User::all();



        //dd($dataUser = User::all());
        $dataValoracion = Valoracion::all();
        $data = Comentarios::find($id);
        return view('comentarios.edit')->with(compact('data', 'dataValoracion', 'dataUser', 'dataMonumentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Comentarios::find($id);
        //$data->PerfilID = $request->PerfilID;
        //$data->id_monumento = $request->id_monumento;
        //$data->tipo_comentario = $request->tipo_comentario;
        $data->descripcion_comentario = $request->descripcion_comentario;

        $data->save();
        return redirect()->route('comentarios.index')->with('success', 'Comentario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Comentarios::find($id)->delete();

        return redirect()->route('comentarios.index')->with('success', 'Comentario borrado correctamente.');
    }
}
