<?php

namespace App\Http\Controllers;

use App\Models\articles;
use App\Models\spots;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $spotId = $id;
        $spot = spots::find($id);
        if (!$spot) {
            return redirect()->route('spots.index')->with('error', 'Spot no encontrado.');
        }

        $articles = Articles::where('spot_id', $spotId)->paginate(1);
        $count = Articles::where('spot_id', $id)->count();

        $identificador = $id;
        return view('articulo.index', compact('identificador', 'articles', 'count'));
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
        $articulo = new articles;
        $articulo->spot_id = $request->iden;
        $articulo->titulo = $request->titulo;
        $articulo->contenido = $request->contenido;
        $articulo->save();
        return redirect()->route('articulo.index', ['id' => $request->iden])->with('msj', 'create');
    }

    /**
     * Display the specified resource.
     */
    public function show(articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $articulo = articles::find($id);
            if (!$vid = articles::find($id)) {
                return redirect()->route('spots.index')->with('msj', 'imposible');
            }
            return view('articulo.edit', compact('articulo'));
        } catch (\Throwable $th) {
            return redirect()->route('spots.index')->with('msj', 'imposible');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $articulo = articles::findOrFail($id);
        $articulo->update([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,

        ]);
        return redirect()->route('articulo.index', ['id' => $articulo->spot_id, 'page' => 1])->with('msj', 'modify');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $articulo = Articles::findOrFail($id);
            $articulo->delete();
            return redirect()->route('articulo.index', ['id' => $articulo->spot_id, 'page' => 1])->with('msj', 'eliminado');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('articulo.index', ['id' => $articulo->spot_id, 'page' => 1])->with('error', 'El artículo no pudo ser encontrado.');
        } catch (\Exception $e) {
            return redirect()->route('articulo.index', ['id' => $articulo->spot_id, 'page' => 1])->with('error', 'Ocurrió un error al eliminar el artículo.');
        }
    }
}
