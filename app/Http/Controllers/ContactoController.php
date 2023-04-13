<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactoForm as Contacto;

class ContactoController extends Controller
{

    public function index()
    {
        $contacto = Contacto::all();
        return view('reporte.index',compact('contacto'));
    }

    public function store(Request $request)
    {
        $contacto = new Contacto();
        $contacto->asunto = $request->get('asunto');
        $contacto->correo = $request->get('correo');
        $contacto->descripcion = $request->get('descripcion');
        $contacto->estatus = $request->get('estatus');
        $contacto->save();
        return redirect()->route('reporte.index')->with('success','Reporte creado con exito');
    }

    public function edit($id)
    {
        $contacto = Contacto::find($id);
        return view('reporte.edit',compact('contacto','id'));
    }

    public function update(Request $request, $id)
    {
        $contacto= Contacto::find($id);
        $contacto->asunto = $request->get('asunto');
        $contacto->correo = $request->get('correo');
        $contacto->descripcion = $request->get('descripcion');
        $contacto->estatus = $request->get('estatus');     
        $contacto->save();
        return redirect()->route('reporte.index')->with('success','Reporte editado con exito');
    }

    public function destroy($id)
    {
        $contacto = Contacto::find($id);
        $contacto->delete();
        return redirect()->route('reporte.index')->with('success','Reporte eliminado con exito');
    }
}
