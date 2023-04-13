<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogoImagen;
use Illuminate\Support\Facades\DB;

class CatalogoImagenesController extends Controller
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
        $data = CatalogoImagen::all();
        return view('catImagen.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('catImagen.create');
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
        $data = new CatalogoImagen;
        $data->tamano = $request->tamano;

        $busqueda = DB::table('catalogo_imagenes')->where('tamano', $request->tamano)->first();
        if ($busqueda == true) {
            return redirect()->route('catImagen.create')->withInput()->with('error', 'Este tamaño ya está registrado.');
        }
        $data->save();

        return redirect()->route('catImagen.index')->with('success', 'Tamaño de imagen creado correctamente.');
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
        $data = CatalogoImagen::find($id);
        return view('catImagen.edit')->with(compact('data'));
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
        $data = CatalogoImagen::find($id);
        $data->tamano = $request->tamano;

        if($request->tamano != $data->tamano){
            $busqueda = DB::table('catalogo_imagenes')->where('tamano', $request->tamano)->first();
        if ($busqueda == true) {
            return redirect()->back()->withInput()->with('error', 'Este tamaño ya está registrado.');
        }
        }
        $data->save();
        return redirect()->route('catImagen.index')->with('success', 'Tamaño de imagen actualizado correctamente.');
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
        $data = CatalogoImagen::find($id);
        $data->delete();
        return redirect()->route('catImagen.index')->with('success', 'Tamaño de imagen eliminado correctamente.');
    }
}
