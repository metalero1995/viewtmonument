<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monumento;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Ciudad;
use App\Models\CatalogoMonumento;
use Illuminate\Support\Facades\DB;


class MonumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        function isValidCoordinates($coordinates) {
            $pattern='/^[-]?\d+[\.]?\d*, [-]?\d+[\.]?\d*$/';
            if (!preg_match($pattern, $coordinates)) {
                return false;
            }
            return true;
        }
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Monumento::all();
        return view('monumento.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataPais = Pais::all();
        $dataTipo = CatalogoMonumento::all();
        return view('monumento.create')->with(compact('dataPais', 'dataTipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        if(isValidCoordinates($request->latitud_monumento . ", " .  $request->longitud_monumento)==false){
            return redirect()->route('monumento.create')->withInput()->with('error', 'Las coordenadas ingresadas son incorrectas.');
        }
        //
        $data = new Monumento;
        $data->id_ciudad = $request->id_ciudad;
        $data->nombre_monumento = $request->nombre_monumento;
        $data->descripcion_monumento = $request->descripcion_monumento;
        $data->anio_monumento = $request->anio_monumento;
        $data->tipo_monumento = $request->tipo_monumento;
        $data->latitud_monumento = $request->latitud_monumento;
        $data->longitud_monumento = $request->longitud_monumento;

        $busqueda = DB::table('monumentos')->where('nombre_monumento', $request->nombre_monumento)->where('id_ciudad',$request->id_ciudad)->first();
        if ($busqueda == true) {
            return redirect()->route('monumento.create')->withInput()->with('error', 'Este monumento ya está registrado en esta ciudad.');
        }
        $data->save();

        return redirect()->route('monumento.index')->with('success', 'Monumento creado correctamente.');
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
        //
        $dataCiudad = Ciudad::all();
        $dataEstado = Estado::all();
        $dataPais = Pais::all();
        $dataTipo = CatalogoMonumento::all();
        $data = Monumento::find($id);
        return view('monumento.edit')->with(compact('data', 'dataCiudad', 'dataEstado','dataPais', 'dataTipo'));
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
        if(isValidCoordinates($request->latitud_monumento . ", " . $request->longitud_monumento)==false){
            return redirect()->back()->withInput()->with('error', 'Las coordenadas ingresadas son incorrectas.');
        }
        //
        $data = Monumento::find($id);
        $data->id_ciudad = $request->id_ciudad;
        $data->nombre_monumento = $request->nombre_monumento;
        $data->descripcion_monumento = $request->descripcion_monumento;
        $data->anio_monumento = $request->anio_monumento;
        $data->tipo_monumento = $request->tipo_monumento;
        $data->latitud_monumento = $request->latitud_monumento;
        $data->longitud_monumento = $request->longitud_monumento;
        if ($request->nombre_monumento != $data->nombre_monumento) {
            $busqueda = DB::table('monumentos')->where('nombre_monumento', $request->nombre_monumento)->first();
            if ($busqueda == true) {
                return redirect()->back()->withInput()->with('error', 'Este monumento ya está registrado.');
            }
        }
        $data->save();
        return redirect()->route('monumento.index')->with('success', 'Monumento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Monumento::find($id);
        $data->delete();
        return redirect()->route('monumento.index')->with('success', 'Monumento eliminado correctamente.');
    }
}
