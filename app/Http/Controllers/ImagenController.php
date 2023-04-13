<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Monumento;
use App\Models\CatalogoImagen;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImagenController extends Controller
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
        $data = Imagen::all();
        return view('imagenes.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataMonumento = Monumento::all();
        $dataImagen = CatalogoImagen::all();
        return view('imagenes.create')->with(compact('dataMonumento', 'dataImagen'));
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
        $data = new Imagen;
        $data->id_imagenes = $request->id_imagenes;
        $data->id_monumento = $request->id_monumento;
        if (isset($request->url_imagen)) {
            if ($request->url_imagen->getClientmimeType() != "image/jpeg" and $request->url_imagen->getClientmimeType() != "image/png" and  $request->url_imagen->getClientmimeType() != "image/jpg" and $request->url_imagen->getClientmimeType() != "image/gif" and $request->url_imagen->getClientmimeType() != "image/bmp" and $request->url_imagen->getClientmimeType() != "image/webp") {
                return redirect()->route('imagenes.create')->withInput()->with('error', 'Formato inválido de imagen.');
            }

            $nombre = Str::random(10) . $request->file('url_imagen')->getClientOriginalName();
            $ruta = 'monument_image/' . time() . $nombre;

            Image::make($request->file('url_imagen'))->resize(1080, 1080)->save(public_path(($ruta)));

            $data->url_imagen = $ruta;
        } else {
            return redirect()->route('imagenes.create')->withInput()->with('error', 'Es obligatorio subir una imagen.');
        }
        $data->descripcion_imagen = $request->descripcion_imagen;

        //Llamamos tabla imagen y traemos de la tabla una imagen que tenga el mismo id que le estamos enviando por el request
        $busqueda = DB::table('imagenes')
            ->where('id_monumento', $request->id_monumento)
            ->where('tipo_imagen', 1);

        if ($request->tipo_imagen == 1) {
            if ($busqueda->count() != 0) {
                return redirect()->route('imagenes.create')->withInput()->with('error', 'Solo se puede agregar una imagen en la relación de aspecto 1:1.');
            }
        }
        $data->tipo_imagen = $request->tipo_imagen;
        $data->save();

        return redirect()->route('imagenes.index')->with('success', 'Imagen cargada correctamente.');
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
        $dataMonumento = Monumento::all();
        $dataImagen = CatalogoImagen::all();
        $data = Imagen::find($id);
        return view('imagenes.edit')->with(compact('data', 'dataMonumento', 'dataImagen'));
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
        $data = Imagen::find($id);
        $data->id_imagenes = $request->id_imagenes;
        $data->id_monumento = $request->id_monumento;
        if (isset($request->url_imagen)) {
            if ($request->url_imagen->getClientmimeType() != "image/jpeg" and $request->url_imagen->getClientmimeType() != "image/png" and  $request->url_imagen->getClientmimeType() != "image/jpg" and $request->url_imagen->getClientmimeType() != "image/gif" and $request->url_imagen->getClientmimeType() != "image/bmp" and $request->url_imagen->getClientmimeType() != "image/webp") {
                return redirect()->route('imagenes.create')->withInput()->with('error', 'Formato inválido de imagen.');
            }

            $nombre = Str::random(10) . $request->file('url_imagen')->getClientOriginalName();
            $ruta = 'monument_image/' . time() . $nombre;

            Image::make($request->file('url_imagen'))->resize(1080, 1080)->save(public_path(($ruta)));

            $data->url_imagen = $ruta;
        } else {
            $data->url_imagen = $data->url_imagen;
        }
        //$data->url_imagen = $request->url_imagen;
        $data->descripcion_imagen = $request->descripcion_imagen;
        $data->tipo_imagen = $request->tipo_imagen;
        $data->save();
        return redirect()->route('imagenes.index')->with('success', 'Imagen cargada y actualizada correctamente.');
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
        $data = Imagen::find($id);
        $data->delete();
        return redirect()->route('imagenes.index')->with('success', 'Imagen eliminada correctamente.');
    }
}
