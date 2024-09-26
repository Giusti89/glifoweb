<?php

namespace App\Http\Controllers;

use App\Models\redes;
use Illuminate\Http\Request;
use App\Models\cliente;
use  Illuminate\Support\Facades\Storage;

class RedesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $identificador = $id;

        $publi = redes::where('spot_id', $id)->paginate(2);
        $count = redes::where('spot_id', $id)->count();

        return view('redes.index', compact('publi', 'identificador', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|alpha|max:50|min:5',
            'url' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], [
            'nombre.required' => 'Introducir el nombre de la red social.',
            'nombre.string' => 'Solo ingrese letras.',
            'nombre.max' => 'Número de caracteres superado.',
            'nombre.min' => 'Número de caracteres insuficiente.',
            'nombre.alpha' => 'El campo solo debe contener letras.',
            'url.required' => 'El link de la red social debe ser escrito.',
            'url.url' => 'Ingresar una URL válida.',
            'image.required' => 'El archivo de la imagen debe ser seleccionado.',
            'image.image' => 'El archivo de la imagen debe ser una imagen.',
            'image.mimes' => 'El archivo de la imagen debe ser de tipo: :values.',
        ]);

        $red = new Redes;

        $red->spot_id = $request->iden;
        $red->nombre = $request->nombre;
        $red->link = $request->url;

        if ($red->spot) {
            $nombreCliente = $red->spot->cliente->nombre;

            if ($request->hasFile('image')) {
                $fotoPerfilPath = $request->file('image')->store("publicidades/$nombreCliente", 'public');
                $red->imagen = $fotoPerfilPath;
            }
            $red->save();
            return redirect()->route('redes.index', $request->iden)->with('msj', 'create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(redes $redes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $reed = redes::find($id);
            $spot_id = $reed->spot_id;
            return view('redes.edit', compact('reed'));
        } catch (\Throwable $th) {
            return redirect()->route('spots.index')->with('msj', 'imposible');
        }
       
        
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Recuperar la instancia de la red social que se actualizará
        $red = redes::find($id);

        if (!$red) {
            return redirect()->route('redes.index')->with('error', 'Red social no encontrada.');
        }

        // Actualizar los campos de la red social
        $red->nombre = $request->nombre;
        $red->link = $request->url;
        $nombreCliente = $red->spot->cliente->nombre;


        // Si se carga una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("public/publicidad/$nombreCliente");
            Storage::delete('public/' . $red->imagen);
            $red->imagen = str_replace('public/', '', $path);
        }
        // Guardar los cambios
        $red->save();
        return redirect()->route('redes.index', $red->spot_id)->with('success', 'Red social actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $red = redes::findOrFail($id);
        // Eliminar imagen asociada si existe
        if ($red->imagen) {
            Storage::delete('public/' . $red->imagen);
        }
        // Eliminar el registro del spot
        $red->delete();

        return redirect()->route('redes.index', $red->spot_id)->with('success', 'red eliminada correctamente.');
    }
}
