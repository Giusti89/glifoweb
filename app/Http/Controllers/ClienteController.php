<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = cliente::all();
        $clientes = Cliente::paginate(5);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El campo nombre debe tener al menos :min caracteres.',

            'contacto.required' => 'El campo contacto es obligatorio.',
            'contacto.min' => 'El campo contacto debe tener al menos :min caracteres.',

            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El campo email ya existe.',

            'direccion.min' => 'El campo direccion debe tener al menos :min caracteres.',

            'image.image' => 'El archivo de la imagen debe ser una imagen.',
            'image.mimes' => 'El archivo de la imagen debe ser de tipo: :values.',
        ];
        $request->validate([
            'nombre' => 'required|min:3',
            'contacto' => 'required|min:7',
            'email' => 'required|email|unique:clientes,email',
            'direccion' => 'nullable|min:10',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], $messages);

        $cliente = new Cliente;

        $cliente->nombre = $request->nombre;
        $cliente->contacto = $request->contacto;
        $cliente->email = $request->email;
        $cliente->direccion=$request->direccion;
        if ($request->hasFile('image')) {          
            $fotoPerfilPath = $request->file('image')->store('cliente', 'public');  
            $cliente->logo_url = $fotoPerfilPath;
        }
        $cliente->save();

        return redirect()->route('clientes.index')->with('msj', 'create');
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clie = Cliente::find($id);

        // Verificar si el cliente existe antes de continuar
        if (!$clie) {
            // Manejar el caso en que el cliente no existe, por ejemplo, redireccionar o mostrar un mensaje de error.
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado.');
        }

        return view('clientes.edit', compact('clie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre es valido',

            'contacto.required' => 'El campo nombre es obligatorio.',
            'contacto.min' => 'El numero no es un numero valido.',

            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Ingresa una dirección de correo electrónico válida.',
            'email.unique' => 'El campo email ya existe.',

            'image' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg o webp.',
        ];
        $request->validate([
            'nombre' => 'required|max:255',
            'contacto' => 'required|min:7',
           'email' => 'required|email|unique:clientes,email,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], $messages);

        $cliente = Cliente::find($id);
        $cliente->nombre = $request->nombre;
        $cliente->contacto = $request->contacto;
        $cliente->email = $request->email;
        $cliente->direccion=$request->direccion;

        if ($request->hasFile('image')) {
            // Procesar la nueva imagen si se proporciona
            $file = $request->file('image');
            $path = Storage::putFile('public/clientes', $file);
            Storage::delete('public/' . $cliente->logo_url);
            $nuevo_path = str_replace('public/', '', $path);
            $cliente->logo_url = $nuevo_path;
        }

        $cliente->save();

        return redirect()->route('clientes.index')->with('msj', 'modify');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            if ($cliente->solicitudes()->count() > 0) {
                return redirect()->route('clientes.index')->with('msj', 'error');
            }
    
            $cliente->delete();
            if ($cliente->logo_url) {
                Storage::delete('public/' . $cliente->logo_url);
            }
    
            // Eliminar la carpeta del cliente si existe
            Storage::deleteDirectory("public/publicidad/$cliente->nombre");
    
            return redirect()->route('clientes.index')->with('msj', 'eliminado');
        } catch (ModelNotFoundException $e) {
            // Manejo de la excepción si el cliente no se encuentra
            return redirect()->route('clientes.index')->with('msj', 'error');
        } catch (\Exception $e) {
            // Otro tipo de excepción
            return redirect()->route('clientes.index')->with('msj', 'error');
        }
    }
}
