<x-app-layout>
    <link rel="stylesheet" href="./css/spots.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publicidad') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <x-layouts.butonCrear contenido="Nueva Publicidad" enlace="spots.create">
                    </x-layouts.butonCrear>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Tipo de publicidad</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Borrar</th>
                                <th>Editar</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publi as $pu)
                                <tr>
                                    <td class="filas-tabla">
                                        {{ $pu->cliente ? $pu->cliente->nombre : 'Cliente no disponible' }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $pu->advertising ? $pu->advertising->nombre : 'Publicidad no disponible' }}
                                    </td>
                                    <td class="filas-tabla">
                                        @if ($pu->boton)
                                            <img class="imgMuestra"
                                                src="../../public/storage/{{ $pu->boton }}"alt="{{ $pu->id }}">
                                        @else
                                            {{ $pu->id }}
                                        @endif
                                    </td>

                                    <td class="filas-tabla">
                                        @if ($pu->estado == 0)
                                            Sin publicar
                                        @else
                                            Publicada
                                        @endif
                                    </td>

                                    <td class="filas-tabla">
                                        <form class="eli" action="{{ route('spot.delete', $pu->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn-eliminar" type="submit">
                                            </button>
                                        </form>
                                    </td>
                                    <td class="filas-tabla">

                                        <a href="{{ route('spot.edit', $pu->id) }}">
                                            <button type="button" class="btn-modificar">
                                                Editar
                                            </button>
                                        </a>
                                    </td>
                                    <td class="filas-tabla">
                                        @if ($pu->advertising->nombre == 'Publicidad Store')
                                            <a href="{{ route('articulo.index', $pu->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    Publicidad Store
                                                </button>
                                            </a>
                                        @elseif($pu->advertising->nombre == 'publicidad con mapa')
                                            <a href="{{ route('articulo.index', $pu->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    Publicidad con mapa
                                                </button>
                                            </a>
                                        @elseif($pu->advertising->nombre == 'publicidad sin mapa')
                                            <a href="{{ route('articulo.index', $pu->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    Publicidad sin mapa
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate">
                    {{ $publi }}
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.eli').submit(function(e) {
                e.preventDefault()

                Swal.fire({
                    title: "¿Estas seguro de eliminar esta publicación?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar"
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
