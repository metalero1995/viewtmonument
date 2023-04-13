<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pais;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dataPais = Pais::all();
        return view('auth.register')->with(compact('dataPais'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile' => ['required', 'numeric'],
            'age'=>['required','numeric','max:120','min:1'],
            'ciudad'=>['required']

        ]);

        $user = User::create([
            'PerfilID' => $request->profile,
            'ciudad' => $request->ciudad,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'age' => $request->age,
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        Auth::login($user);

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
    
            return redirect('/login');       
        }
    }
}
