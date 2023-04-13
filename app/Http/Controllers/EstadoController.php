<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;


class EstadoController extends Controller
{
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
        $data = Estado::all();
        return view('estado.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Estado::all();
        $data2 = Pais::all();
        return view('estado.create')->with(compact('data','data2')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $busqueda = DB::table('estados')->where('nombre_estado', $request->nombre_estado)->where('id_pais',$request->id_pais)->first();

            if ($busqueda == true){
             return redirect()->back()->withInput()->with('error', 'Esta estado ya está registrado en ese pais.');
            }        
        $data = new Estado;
        //$data->id = $request->id;
        $data->id_pais = $request->id_pais;
        $data->nombre_estado = $request->nombre_estado;
        $data->descripcion_estado = $request->descripcion_estado;
        //$data->created_at = $request->created_at;
        //$data->update_at = $request->update_at;
      
            $data->save();
            return redirect()->route('estado.index')->with('success', 'Estado creado correctamente.');
        
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
        $data = Estado::find($id);
        $data2 = Pais::all();
        return view('estado.edit')->with(compact('data','data2')); 
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
        $data = Estado::find($id);
        if ($request->nombre_estado != $data->nombre_estado) {
            
            $busqueda = DB::table('estados')->where('nombre_estado', $request->nombre_estado)->where('id_pais',$request->id_pais)->first();

            if ($busqueda == true){
             return redirect()->back()->withInput()->with('error', 'Esta estado ya está registrado en ese pais.');
            }  
        }
        $data->id_pais = $request->id_pais;
        $data->nombre_estado = $request->nombre_estado;
        $data->descripcion_estado = $request->descripcion_estado;
        $data->save();

        return redirect()->route('estado.index')->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Estado::find($id);
        $data->delete();
        return redirect()->route('estado.index')->with('success', 'Estado borrado correctamente.');
    }
}
