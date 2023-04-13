<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\RevisadoReporte;
class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Reporte::all();
        return view('reporte.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Reporte::all();
        $data2 = RevisadoReporte::all();
        return view('reporte.create')->with(compact('data', 'data2'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Reporte;
        $data->correo_reporte = $request->correo_reporte;
        $data->asunto_reporte = $request->asunto_reporte;
        $data->descripcion_reporte = $request->descripcion_reporte;
        $data->revisado_reporte = $request->revisado_reporte;
        $data->save();

        return redirect()->route('reporte.index')->with('success', 'Reporte creado correctamente.');
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
        $data = Reporte::find($id);
        $data2 = RevisadoReporte::all();
        return view('reporte.edit')->with(compact('data', 'data2'));
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
        $data = Reporte::find($id);
        $data->correo_reporte = $request->correo_reporte;
        $data->asunto_reporte = $request->asunto_reporte;
        $data->descripcion_reporte = $request->descripcion_reporte;
        $data->revisado_reporte = $request->revisado_reporte;
        $data->save();

        return redirect()->route('reporte.index')->with('success', 'Reporte actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Reporte::find($id);
        $data->deleted_at = now();
        $data->save();
        return redirect()->route('reporte.index')->with('success', 'Reporte borrado correctamente.');
    }
}
