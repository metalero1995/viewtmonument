<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\interacciones;
use App\Models\Pais;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class PerfilUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dataUser = User::find($id);
    
        $dataInteracciones = interacciones::with('monumento')
        ->whereIn('id_usuario', [$id])
        ->orderBy('updated_at', 'desc')
        ->limit(3)
        ->get();

        $dataPais = Pais::all();
        if (!$dataUser) {
            abort(403, 'User not found');
        }else{
            return view('usuario')->with(compact('dataUser','dataInteracciones','dataPais'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *php
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

         //Validaciones
         $data = User::find($id);
         
         if ($request->email == $data->email and $request->email == $data->email) {

         } else {

         }
 
         $message = 0;
 
         if ($request->email != $data->email) {
             $busqueda = DB::table('users')->where('email', $request->email)->first();
             if ($busqueda == true) {
                 $message = 1;
             }
         }
         if ($request->mobile != $data->mobile) {
             $busqueda = DB::table('users')->where('mobile', $request->mobile)->first();
             if ($busqueda == true) {
                 $message = 2 + $message;
             }
         }
 
         switch ($message) {
             case 1:
                 return redirect()->back()->withInput()->with('error', 'Este correo electrónico ya está registrado.');
                 break;
             case 2:
                 return redirect()->back()->withInput()->with('error', 'Este teléfono ya está registrado.');
                 break;
             case 3:
                 return redirect()->back()->withInput()->with('error', 'Este correo electrónico y teléfono ya están registrados.');
                 break;
         }

         if (isset($request->photo)) {
            
             if ($request->photo->getClientmimeType() != "image/png" and $request->photo->getClientmimeType() != "image/jpeg" and $request->photo->getClientmimeType() != "image/jpg" and $request->photo->getClientmimeType() != "image/gif" and $request->photo->getClientmimeType() != "image/bmp" and $request->photo->getClientmimeType() != "image/webp") {
                 return redirect()->back()->withInput()->with('error', 'Formato inválido de imagen.');
             }
             //Este if borra la foto que tenga actualmente el usuario
 
             if ($data->photo != null) {
                 unlink(public_path($data->photo));
             }

             $nombre = Str::random(10) . $request->file('photo')->getClientOriginalName();
             $ruta = 'users_image/' . time() . $nombre;
             Image::make($request->file('photo'))->resize(256, 256)->save(public_path(($ruta)));
 
             $data->photo = $ruta;
         } else {
             $data->photo = $data->photo;
         }
         if ($request->name != null) {
            $data->name = $request->name;
         }
         if ($request->age != null) {
            $data->age = $request->age;
         }
         if ($request->gender != null) {
             $data->gender = $request->gender;
         }
         if ($request->email != null) {
            $data->email = $request->email;
         }
         if ($request->address != null) {
            $data->address = $request->address;
         }
         if ($request->mobile != null) {
         $data->mobile = $request->mobile;
         }
         $data->save();

         //return view('usuario.update');

    }
    public function updatephoto(Request $request, $id)
    {         
         //Validaciones
         $data = User::find($id);

         //$data->photo = $request->photo;
         if (isset($request->photo)) {
            
             if ($request->photo->getClientmimeType() != "image/png" and $request->photo->getClientmimeType() != "image/jpeg" and $request->photo->getClientmimeType() != "image/jpg" and $request->photo->getClientmimeType() != "image/gif" and $request->photo->getClientmimeType() != "image/bmp" and $request->photo->getClientmimeType() != "image/webp") {
                 return redirect()->back()->withInput()->with('error', 'Formato inválido de imagen.');
             }
             //Este if borra la foto que tenga actualmente el usuario
 
             if ($data->photo != null) {
                 unlink(public_path($data->photo));
             }

             $nombre = Str::random(10) . $request->file('photo')->getClientOriginalName();
             $ruta = 'users_image/' . time() . $nombre;
             Image::make($request->file('photo'))->resize(256, 256)->save(public_path(($ruta)));
 
             $data->photo = $ruta;
         } else {
             $data->photo = $data->photo;
         }
         $data->save();
         return redirect()->route('usuario', ['id' => $id]);

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
    }
}
