<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValoracionController extends Controller
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
        $data = Valoracion::all();
        return view('valoracion.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('valoracion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Valoracion();
        $busqueda = DB::table('valoracion')->where('descripcion', $request->descripcion)->first();
        if ($busqueda == true) {
            return redirect()->route('valoracion.create')->withInput()->with('error', 'Esta valoración ya está registrado.');
        }
        $data->descripcion = $request->descripcion;
        $data->save();
        return redirect()->route('valoracion.index')->with('success', 'Valoración creada correctamente.');
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
        $data = Valoracion::find($id);
        return view('valoracion.edit')->with(compact('data'));
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
        $data = Valoracion::find($id);
        if ($data->descripcion = !$request->descripcion) {
            $busqueda = DB::table('valoracion')->where('descripcion', $request->descripcion)->first();
            if ($busqueda == true) {
                return redirect()->route('valoracion.create')->withInput()->with('error', 'Esta valoración ya está registrado.');
            }
        }

        $data->tipo_comentario = $request->tipo_comentario;
        $data->descripcion = $request->descripcion;
        $data->save();
        return redirect()->route('valoracion.index')->with('success', 'Valoracion actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Valoracion::find($id);

        $data->deleted_at = now();
        $data->save();
        return redirect()->route('valoracion.index')->with('success', 'Valoracion borrada correctamente.');
    }
}
