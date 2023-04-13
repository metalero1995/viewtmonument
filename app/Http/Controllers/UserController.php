<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Pais;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class UserController extends Controller

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
        $data = User::all();
        return view('user.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = User::all();
        $data2 = Perfil::all();
        $dataPais = Pais::all();

        //dd(session('last_url'));
        return view('user.create')->with(compact('data', 'data2', 'dataPais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validaciones
        $message = 0;
        $busqueda = DB::table('users')->where('email', $request->email)->first();
        if ($busqueda == true) {
            $message = 1;
        }
        if ($request->mobile != null) {
            $busqueda = DB::table('users')->where('mobile', $request->mobile)->first();
            if ($busqueda == true) {
                $message = 2 + $message;
            }
        }
        switch ($message) {
            case 1:
                return redirect()->route('user.create')->withInput()->with('error', 'Este correo electrónico ya está registrado.');
                break;
            case 2:
                return redirect()->route('user.create')->withInput()->with('error', 'Este teléfono ya está registrado.');
                break;
            case 3:
                return redirect()->route('user.create')->withInput()->with('error', 'Este correo electrónico y teléfono ya están registrados.');
                break;
        }

        $data = new User;
        if (isset($request->photo)) {
            if ($request->photo->getClientmimeType() != "image/png" and $request->photo->getClientmimeType() != "image/jpeg" and  $request->photo->getClientmimeType() != "image/jpg" and $request->photo->getClientmimeType() != "image/gif" and $request->photo->getClientmimeType() != "image/bmp" and $request->photo->getClientmimeType() != "image/webp") {
                return redirect()->route('user.create')->withInput()->with('error', 'Formato inválido de imagen.');
            }

            $nombre = Str::random(10) . $request->file('photo')->getClientOriginalName();
            $ruta = 'users_image/' . time() . $nombre;

            Image::make($request->file('photo'))->resize(256, 256)->save(public_path(($ruta)));

            $data->photo = $ruta;
        } else {
            $data->photo = $request->photo;
        }
        //User::create($requestData);

        $data->PerfilID = $request->PerfilID;
        $data->name = $request->name;
        $data->age = $request->age;
        $data->ciudad = $request->ciudad;
        $data->gender = $request->gender;
        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        //$data->created_at = $request->created_at;
        //$data->update_at = $request->update_at;
        $data->save();

        return redirect()->route('user.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        $data2 = Perfil::all();
        return view('user_edit.index')->with(compact('data', 'data2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $data2 = Perfil::all();
        return view('user.edit')->with(compact('data', 'data2'));
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
        $data->PerfilID = $request->PerfilID;
        $data->name = $request->name;
        $data->age = $request->age;
        if ($request->gender != null) {
            $data->gender = $request->gender;
        }
        $data->email = $request->email;
        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $data->save();

        return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);

        if ($data->photo != null) {
            unlink(public_path($data->photo));
        }
        $data->delete();
        return redirect()->route('user.index')->with('success', 'Usuario borrado correctamente.');
    }
}
