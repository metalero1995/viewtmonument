<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogoMonumento;
use Illuminate\Support\Facades\DB;

class CatalogoMonumentosController extends Controller
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
        //
        $data = CatalogoMonumento::all();
        return view('catMonumento.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('catMonumento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = new CatalogoMonumento;
        $data->descripcion = $request->descripcion;

        $busqueda = DB::table('catalogo_monumentos')->where('descripcion', $request->descripcion)->first();
        if ($busqueda == true) {
            return redirect()->route('catMonumento.create')->withInput()->with('error', 'Esta clasifiación ya está registrada.');
        }
        $data->save();



        return redirect()->route('catMonumento.index')->with('success', 'Clasificación creada correctamente');
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
        $data = CatalogoMonumento::find($id);
        return view('catMonumento.edit')->with(compact('data'));
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
        //
        $data = CatalogoMonumento::find($id);
        $data->descripcion = $request->descripcion;
        
        if($request->descripcion != $data->descripcion){
            $busqueda = DB::table('catalogo_monumentos')->where('descripcion', $request->descripcion)->first();
            if($busqueda == true){
                return redirect()->back()->withInput()->with('error', 'Esta clasifiación ya está registrada.');
            }
        }
        $data->save();
        return redirect()->route('catMonumento.index')->with('success', 'Clasificación actualizada correctamente.');
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
        $data = CatalogoMonumento::find($id);
        $data->delete();
        return redirect()->route('catMonumento.index')->with('success', 'Clasifiación eliminada correctamente.');
    }
}
