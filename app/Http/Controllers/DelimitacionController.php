<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delimitacion;
use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\Pais;

class DelimitacionController extends Controller
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
        $data = Delimitacion::all();
        return view('delimitacion.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('delimitacion.create');
        $data = Delimitacion::all();
        $dataPais = Pais::all();
        $dataEstado = Estado::all();
        $dataCiudad = Ciudad::all();

        //dd(session('last_url'));
        return view('delimitacion.create')->with(compact('data', 'dataPais','dataEstado','dataCiudad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isValidCoordinates($request->latitud_delimitacion . ", " .  $request->longitud_delimitacion)==false){
            return redirect()->back()->withInput()->with('error', 'Las coordenadas ingresadas son incorrectas.');
        }
        $data = new Delimitacion;
        $data->id_ciudad = $request->id_ciudad;
        $data->latitud_delimitacion = $request->latitud_delimitacion;
        $data->longitud_delimitacion = $request->longitud_delimitacion;
        $data->save();

        return redirect()->route('delimitacion.index')->with('success', 'Delimitación creada correctamente.');
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
        $data = Delimitacion::find($id);
        $dataPais = Pais::all();
        $dataEstado = Estado::all();
        $dataCiudad = Ciudad::all();
        return view('delimitacion.edit')->with(compact('data', 'dataPais','dataEstado','dataCiudad'));
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
        //dd($request->latitud_delimitacion . ", " .  $request->longitud_delimitacion);

        if(isValidCoordinates($request->latitud_delimitacion . ", " .  $request->longitud_delimitacion)==false){
            return redirect()->back()->withInput()->with('error', 'Las coordenadas ingresadas son incorrectas.');
        }

        $data = Delimitacion::find($id);
        //$data->id_delimitacion = $request->dide_delimitacion;
        //$data->id_ciudad = $request->id_ciudad;
        //$data->id_estado = $request->id_estado;
        //$data->id_pais = $request->id_pais;
        $data->latitud_delimitacion = $request->latitud_delimitacion;
        $data->longitud_delimitacion = $request->longitud_delimitacion;
        $data->save();
        return redirect()->route('delimitacion.index')->with('success', 'Delimitación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Delimitacion::find($id);
        $data->delete();
       
        return redirect()->route('delimitacion.index')->with('success', 'Delimitación borrada correctamente.');
    }
}
