<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use Illuminate\Support\Facades\DB;


class PerfilController extends Controller
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

    //MÉTODO DONDE LISTAMOS TODOS LOS PERFILES
    public function index()
    {
        $data = Perfil::all();
        //dd($data);
        return view('perfil.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //MÉTODO DONDE MOSTRAMOS LA VISTA DE LA CREACIÓN DEL PERFIL 
    public function create()
    {
        return view('perfil.create');
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
        $data = new Perfil;
        $data->descripcion = $request->descripcion;
        $data->comentario = $request->comentario;


        $busqueda = DB::table('perfiles')->where('descripcion', $request->descripcion)->first();
        if ($busqueda == true) {
            return redirect()->route('perfil.create')->withInput()->with('error', 'Este perfil/rol ya está registrado.');
        } else {
            $data->save();
            return redirect()->route('perfil.index')->with('success', 'Perfil creado correctamente.');
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
        $data = Perfil::find($id);
        $data2 = Perfil::all();
        return view('perfil.edit')->with(compact('data', 'data2'));
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
        $data = Perfil::find($id);


        if ($request->descripcion != $data->descripcion) {
            $busqueda = DB::table('perfiles')->where('descripcion', $request->descripcion)->first();
            if ($busqueda == true) {
                return redirect()->back()->withInput()->with('error', 'Este perfil/rol ya está registrado.');
            }
        }else{
          
        }
        $data->descripcion = $request->descripcion;
        $data->comentario = $request->comentario;
        $data->save();
        return redirect()->route('perfil.index')->with('success', 'Perfil/Rol actualizado correctamente.');
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

        $data = Perfil::find($id);
        $data->delete();
        return redirect()->route('perfil.index')->with('success', 'Perfil borrado correctamente.');

        //Brrado lógic
    }
}
