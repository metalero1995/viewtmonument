<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;


class CiudadController extends Controller
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
        $data = Ciudad::all();

        return view('ciudad.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Ciudad::all();
        $data2 = Estado::all();
        $data3 = Pais::all();
        return view('ciudad.create')->with(compact('data','data2','data3')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Ciudad;
        $busqueda = DB::table('ciudades')->where('nombre_ciudad', $request->nombre_ciudad)->where('id_estado',$request->id_estado)->first();

            if ($busqueda == true){
             return redirect()->back()->withInput()->with('error', 'Esta ciudad ya está registrada en ese estado.');
            }        
      
        
        //$data->id = $request->id;
        $data->id_pais = $request->id_pais;
        $data->id_estado = $request->id_estado;
        $data->nombre_ciudad = $request->nombre_ciudad;
        $data->descripcion_ciudad = $request->descripcion_ciudad;
        //$data->created_at = $request->created_at;
        //$data->update_at = $request->update_at;
        $data->save();

        return redirect()->route('ciudad.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ciudad::find($id);
        $data2 = Estado::all();
        $data3 = Pais::all();
        return view('ciudad.edit')->with(compact('data','data2','data3')); 
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
        $data = Ciudad::find($id);
        if ($request->nombre_ciudad != $data->nombre_ciudad) {
            $busqueda = DB::table('ciudades')->where('nombre_ciudad', $request->nombre_ciudad)->where('id_estado',$request->id_estado)->first();

            if ($busqueda == true){
             return redirect()->back()->withInput()->with('error', 'Esta ciudad ya está registrada en ese estado.');
            }        
            
        }
        $data->id_pais = $request->id_pais;
        $data->id_estado = $request->id_estado;
        $data->nombre_ciudad = $request->nombre_ciudad;
        $data->descripcion_ciudad = $request->descripcion_ciudad;
        $data->save();

        return redirect()->route('ciudad.index')->with('success', 'Ciudad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ciudad::find($id);
        $data->delete();
        return redirect()->route('ciudad.index')->with('success', 'Ciudad borrada correctamente.');
    }
}
