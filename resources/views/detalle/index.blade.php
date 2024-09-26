<x-layouts.menus url="../css/detalle.css">
    <div class="principal">
        <div class="lienzo">
            <div class="cabezera">


                <form action="{{ route('detalle.store') }}" class="formulario" method="post">
                    @csrf
                    <div class="forml">
                        <div class="selectores">
                            <label class="subT" for="">Subprodutos</label>
                            <div class="sel">
                                <select id="sub" name="subproducto" class="selector">
                                    <option value=""></option>
                                    @foreach ($sub as $nombre => $id)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <input name="identificador" type="text" value="{{ $marcador }}" hidden>
                            </div>
                        </div>

                        <div class="botones">
                            <button data-modal-toggle="defaultModal" type="submit" class="crear">Agregar</button>
                            <a href="{{ route('solicitudes.index', $marcador) }}">
                                <button data-modal-toggle="defaultModal" type="button" class="close">Cancelar</button>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
            <div class="cuer">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Costo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles as $detalle)
                                <tr>
                                    <td class="filas-tabla">
                                        {{ $detalle->detalleID }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $detalle->nombres }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $detalle->costo }}
                                    </td>

                                    <td class="filas-tabla">
                                        <form class="eli" action="{{ route('detalle.destroy', $detalle->detalleID) }}"
                                            class="formulario-eliminar" id="formulario-eliminar" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn-eliminar" type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Balance</th>
                                <td class="filas-tabla" colspan="1"></td>

                                <td class="filas-tabla" colspan="1"> {{ $suma }}</td>
                                <td class="filas-tabla"></td>

                            </tr>

                        </tfoot>
                    </table>
                    <form action="{{ route('terminado', $marcador) }}" class="formulario" method="post">
                        @method('PUT')
                        @csrf
                        <div class="botones">
                            <button data-modal-toggle="defaultModal" type="submit" class="crear">Dar alta</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="paginate">
        {{ $detalles }}
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