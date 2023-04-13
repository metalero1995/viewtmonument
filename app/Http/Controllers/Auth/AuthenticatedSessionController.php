<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        //BUSCAR EL PERFIL ID DEL USUARIO Y REDIRIGIRLO
        $todosUsuarios = User::all();

        $email = $request->email;

        $idPerfil=0;
        $idPersona=0;

        foreach($todosUsuarios as $users){
            if($users->email == $email){
                $idPerfil = $users->PerfilID;
                $idPersona = $users->id;
                break;
            }
        }
        $idPersona = (string)$idPersona;

        if($idPerfil == 1){
            return redirect()->intended(RouteServiceProvider::HOME);
        }elseif($idPerfil ==2){
            return redirect()->intended(RouteServiceProvider::USER . $idPersona);
        }elseif($idPerfil ==3){
            Auth::guard('web')->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/login');        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
