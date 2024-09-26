<x-layouts.menus url="../css/artedit.css">
    <div class="titulo">
        <h3>Realice las modificaciones pertinentes</h3>
    </div>
   
    <div class="formulario">
        
        
        <form class="fmdatos" action="{{ route('articulo.update', $articulo->id) }}" method="post">
            @method('PUT')
            @csrf
            
            <input name="identificador" id="identificador" value="{{ $articulo->spot_id }}" type="hidden" >

            <label for="">Titulo:</label>
            <input type="text" name="titulo" id="titulo" required value="{{ $articulo->titulo }}">           

            <label for="">Contenido:</label>
            <textarea name="contenido" id="contenido" cols="40" rows="15">{{ $articulo->contenido }}</textarea>            

            <div class="botones">
                <button   class="editar">Modificar</button>  
                <a href="{{ route('articulo.index',$articulo->spot_id) }}" style="color: red">
                    <button data-modal-toggle="defaultModal" type="button" class="underline ml-4">Regresar</button>
                </a>              
            </div>
        </form>
        
        
    </div>
    
</x-layouts.menus>