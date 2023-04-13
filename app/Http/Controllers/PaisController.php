<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
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

    //MÉTODO DONDE LISTAMOS TODOS LOS PAISES
    public function index()
    {
        $data = Pais::all();
        //dd($data);
        return view('pais.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //MÉTODO DONDE MOSTRAMOS LA VISTA DE LA CREACIÓN DEL PAISES
    public function create()
    {
        return view('pais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //MÉTODO DONDE HACEMOS LA CREACIÓN DEL PERFIL
    public function store(Request $request)
    {
        $data = new Pais;
        $data->nombre_pais = $request->nombre_pais;
        $data->descripcion_pais = $request->descripcion_pais;

        $busqueda = DB::table('paises')->where('nombre_pais', $request->nombre_pais)->first();
        if ($busqueda == true) {
            return redirect()->route('pais.create')->withInput()->with('error', 'Este pais ya está registrado.');
        } else {
            $data->save();
            return redirect()->route('pais.index')->with('success', 'País creado correctamente.');
        }
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

    //MÉTODO DONDE MOSTRAMOS LA VISTA DE LA EDICIÓN DEL PERFIL 
    public function edit($id)
    {
        $data = Pais::find($id);
        return view('pais.edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //MÉTODO DONDE HACEMOS LA MODIFICACIÓN DEL PERFIL
    public function update(Request $request, $id)
    {
        $data = Pais::find($id);
        if ($request->nombre_pais != $data->nombre_pais) {
            $busqueda = DB::table('paises')->where('nombre_pais', $request->nombre_pais)->first();
            if ($busqueda == true) {
                return redirect()->back()->withInput()->with('error', 'Este pais ya está registrado.');
            }
        }
        $data->nombre_pais = $request->nombre_pais;
        $data->descripcion_pais = $request->descripcion_pais;
        $data->save();

        return redirect()->route('pais.index')->with('success', 'Pais actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //MÉTODO DONDE HACEMOS LA ELIMINACIÓN DEL PERFIL
    public function destroy($id)
    {
        //Borrado físico
        //dd($id);
        /*
       $data = Perfil::find($id);
       $data->delete();
       return redirect()->route('perfil.index');
       */
        //Borrado lógico
        $data = Pais::find($id);
        $data->deleted_at = now();
        $data->save();
        return redirect()->route('pais.index')->with('success', 'Pais borrado correctamente.');
    }
}
