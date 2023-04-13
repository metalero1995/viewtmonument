<?php

namespace App\Http\Controllers;
use App\Models\ContactoMongoAllUser as Contacto;

use Illuminate\Http\Request;

class ContactoMongoAllUserController extends Controller
{
    //
    public function store(Request $request)
    {
        $contacto = new Contacto();
        $contacto->asunto = $request->get('asunto');
        $contacto->correo = $request->get('email');
        $contacto->descripcion = $request->get('descripcion');
        $contacto->estatus = 'No revisado';
        $contacto->save();
        return redirect()->route('contacto')->with('success', 'Reporte enviado con exito');
    }
}
