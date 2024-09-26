<x-layouts.menus url="../css/nuevosubProducto.css">
<div class="total">
    <div class="titulo">
        @if ($resultado->isNotEmpty() && $resultado->first()->servicio)
           <h4> Productos del área de: {{ $resultado->first()->servicio->nombre }}</h4>
        @else
            No hay productos en este Servicio
        @endif
    </div>
    <div class="btnNprod">
        <a href="{{ route('nproducto', $idserv) }}">
            <button data-modal-toggle="defaultModal" type="button" class="editar">Crear
                Producto
            </button>
        </a>
    </div>
    <div class="formulario">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Sub Productos</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultado as $dat)
                        <tr>
                            <td class="filas-tabla">
                                {{ $dat->codigo }}
                            </td>
                            <td class="filas-tabla">
                                {{ $dat->nombre }}
                            </td>
                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <a href="{{ route('subproductos', $dat->id) }}">
                                        <button data-modal-toggle="defaultModal" type="button" class="editar">
                                            Sub productos
                                        </button>
                                    </a>
                                </div>
                            </td>
                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <form action="{{ route('eliminarprod', $dat->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="borrar" type="submit">
                                            
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="botones">
            <a href="{{ route('cservicios.store') }}">
                <button type="button" class="close">Regresar</button>
            </a>
        </div>
    </div>
    <div class="paginate">
        {{ $resultado }}
    </div>
 </div>  
    
</x-layouts.menus>
