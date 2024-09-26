<x-layouts.pstore 
logoCliente="{{$logoCliente}}"
titulo="{{$nombreCliente}}" 
imagenPrincipal="{{$image->ruta}}"
tituloArticulo="{{$article->titulo}}"
textoArticulo="{{$article->contenido}}" 
:redes="$redes" 
videoPrincipal="{{$video->ruta}}"
:articulo="$store" >
</x-layouts.pstore>

