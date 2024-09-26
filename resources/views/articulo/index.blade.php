<x-layouts.menus url="../../css/storepub.css">
    <div class="carga-video">
        <div class="titulo">
            <h3>Carga del Articulo Principal</h3>
        </div>
        <div class="visualizar">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Modificar</th>
                        <th>Eliminarr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $art)
                        <tr>
                            <td class="filas-tabla">
                                {{ $art->id }}
                            </td>
                            <td class="filas-tabla">
                                {{ $art->titulo }}
                            </td>
                            <td class="filas-tabla" id="descripcion">
                                {{ $art->contenido }}
                            </td>
                            <td class="filas-tabla">
                                <a href=" {{ route('articulo.edit', $art->id) }}">
                                    <button type="button" class="btn-modificar">
                                        MODIFICAR
                                    </button>
                                </a>
                            </td>

                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <form class="eli" action="{{ route('articulo.delete', $art->id) }}" method="post">
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
            <div class="paginate">
                {{ $articles }}
            </div>
        </div>
        <div class="frm-carga">
            <form class="fmdatos" action={{ route('articulo.store') }} method="post">
                @csrf
                <input type="text" name="iden" id="iden" hidden value="{{ $identificador }}">
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" required value="{{ old('titulo') }}"
                    placeholder="Ingresar titulo">

                <label for="contenido">Contenido</label>
                <textarea name="contenido" id="contenido" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500">{{ old('contenido') }}
                </textarea>

                <div class="botones">
                    @if ($count > 0)
                        <a href="{{ route('redes.index', $identificador) }}">
                            <button data-modal-toggle="defaultModal" type="button" class="crear">Siguiente</button>
                        </a>
                    @else
                        <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                    @endif
                    <a href="{{ route('spots.index',$identificador) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
    @section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.eli').submit(function(e) {
            e.preventDefault()

            Swal.fire({
                title: "¿Estas seguro de eliminar este servicio?",
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
</x-layouts.menus>
