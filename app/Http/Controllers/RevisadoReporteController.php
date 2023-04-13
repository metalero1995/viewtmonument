<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RevisadoReporte;

use Illuminate\Support\Facades\DB;


class RevisadoReporteController extends Controller
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
        $data = RevisadoReporte::all();
        return view('reporte_estatus.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reporte_estatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new RevisadoReporte;
        $data->descripcion = $request->descripcion;
        $data->comentario = $request->comentario;

        $busqueda = DB::table('estatus_reportes')->where('descripcion', $request->descripcion)->first();
        if ($busqueda == true) {
            return redirect()->route('reporte_estatus.create')->withInput()->with('error', 'Este estatus de reporte ya está registrado.');
        }
        $data->save();

        return redirect()->route('reporte_estatus.index')->with('success', 'Estatus de reporte creado correctamente.');
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
        $data = RevisadoReporte::find($id);

        return view('reporte_estatus.edit')->with(compact('data'));
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
        $data = RevisadoReporte::find($id);
        $data->descripcion = $request->descripcion;
        $data->comentario = $request->comentario;

        if ($data->comentario != $request->comentario) {
            $busqueda = DB::table('estatus_reportes')->where('descripcion', $request->descripcion)->first();
            if ($busqueda == true) {
                return redirect()->route('reporte_estatus.create')->withInput()->with('error', 'Este estatus de reporte ya está registrado.');
            }
        }
        $data->save();

        return redirect()->route('reporte_estatus.index')->with('success', 'Estatus de reporte actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RevisadoReporte::find($id);
        $data->delete();

        return redirect()->route('reporte_estatus.index')->with('success', 'Estatus de reporte borrado correctamente.');
    }
}
