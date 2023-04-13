<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
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
        $contadorUsuariosGeneral = DB::table('users')->count();
        $dataTotalPaises = Pais::all();
        $contadorPaisesGeneral = DB::table('paises')->count();
        $contadorUsuariosHombre = DB::table('users')->where('gender', 'Hombre')->count();
        $contadorUsuariosMujer = DB::table('users')->where('gender', 'Mujer')->count();
        $contadorUsuariosOtro = DB::table('users')->where('gender', 'Otro')->count();
        $contadorPaisesIndividual = DB::table('paises')->groupBy('id_pais')->count();
        $contadorMonumentosGeneral = DB::table('monumentos')->count();
        $contadorUsuariosPorPaises = DB::select( DB::raw("SELECT COUNT(paises.id_pais) AS PaisesPorUsuarios FROM users INNER JOIN ciudades ON users.ciudad = ciudades.id_ciudad INNER JOIN paises ON ciudades.id_pais = paises.id_pais GROUP BY paises.id_pais") );
       // dd($contadorUsuariosPorPaises);
        $data = User::all();
        return view('dashboard')->with(compact('contadorUsuariosPorPaises','contadorPaisesIndividual','dataTotalPaises','contadorPaisesGeneral','contadorUsuariosGeneral','contadorMonumentosGeneral','data','contadorUsuariosHombre','contadorUsuariosMujer','contadorUsuariosOtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
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
        //
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
