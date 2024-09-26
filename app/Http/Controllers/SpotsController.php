<?php

namespace App\Http\Controllers;

use App\Models\advertisings;
use App\Models\articles;
use App\Models\cliente;
use App\Models\spots;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publi = spots::paginate(5);
        return view('spots.index', compact('publi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = cliente::pluck('id', 'nombre');
        $publi = advertisings::get(['id', 'nombre', 'descripcion']);
        return view('spots.create', compact('publi', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'cliente.required' => 'Seleccione un cliente.',
            'publicidad.required' => 'Seleccione una publicidad.',
            'slug.required' => 'Ingresar la URL valida.',
            'slug.unique' => 'El slug ya existe.',

            'image.required' => 'El archivo de la imagen debe ser seleccionado.',
            'image.image' => 'El archivo de la imagen debe ser una imagen.',
            'image.mimes' => 'El archivo de la imagen debe ser de tipo: :values.',
        ];

        $request->validate([
            'cliente' => 'required',
            'publicidad' => 'required',
            'slug' => 'required|unique:spots,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], $messages);

        $spot = new spots;
        $spot->cliente_id = $request->cliente;
        $spot->advertising_id = $request->publicidad;
        $nombreProducto = $request->slug;
        $slug = Str::slug($nombreProducto);

        $spot->slug = $slug;

        if ($request->hasFile('image')) {
            $fotoPerfilPath = $request->file('image')->store('publicidades/botones', 'public');
            $spot->boton = $fotoPerfilPath;
        }
        $spot->save();

        return redirect()->route('spots.index')->with('msj', 'create');
    }

    /**
     * Display the specified resource.
     */
    public function show(spots $spots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $publicidad = spots::find($id);

            $publi = advertisings::get(['id', 'nombre', 'descripcion']);

            if ($publicidad) {
                $id = $publicidad->id;
                $clienteId = $publicidad->cliente_id;
                $boton = $publicidad->boton;
                $advertisingId = $publicidad->advertising_id;
            }

            return view('spots.edit', compact('publicidad', 'advertisingId', 'publi'));
        } catch (\Throwable $th) {
            return redirect()->route('spots.index')->with('msj', 'imposible');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'publicidad' => 'required|exists:advertisings,id',
            'image' => 'image|mimes:jpeg,png,webp|max:2048',
        ]);
       

        $spot = spots::find($id);
       
        if (!$spot) {
            return redirect()->route('spots.index')->with('error', 'Spot no encontrado.');
        }

        $cambiosRealizados = false;

        if ($spot->advertising_id != $request->publicidad||$spot->estado !=$request->activo) {
            $spot->advertising_id = $request->publicidad;
            $spot->estado = $request->activo;
            $cambiosRealizados = true;
        }

        

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($spot->boton) {
                Storage::delete('public/' . $spot->boton);
            }
            $path = Storage::putFile('public/publicidades/botones', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $spot->boton = $nuevo_path;
            $cambiosRealizados = true;
        }

        if ($cambiosRealizados) {
            $spot->save();
            return redirect()->route('spots.index')->with('success', 'Spot actualizado exitosamente.');
        }

        return redirect()->route('spots.index')->with('warning', 'No se realizaron cambios en el spot.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $spot = Spots::findOrFail($id);
            $count = articles::where('spot_id', $spot->id)->count();

            if ($count > 0) {
                return redirect()->route('spots.index')->with('error', 'La publicidad no puede ser eliminada');
            } else {
                $spot->delete();
                if ($spot->boton) {
                    Storage::delete('public/' . $spot->boton);
                }

                return redirect()->route('spots.index')->with('success', 'Publicidad eliminada correctamente.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('spots.index')->with('error', 'La publicidad no pudo ser encontrada.');
        } catch (\Exception $e) {
            return redirect()->route('spots.index')->with('error', 'No se puede borrar la publicidad.');
        }
    }
}
