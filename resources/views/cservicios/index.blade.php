<x-app-layout>
    <link rel="stylesheet" href="./css/cservicios.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicios') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-layouts.butonCrear contenido="Crear Servicio" enlace="{{ route('cservicios.nuevo') }}">
                    </x-layouts.butonCrear>

                </div>
                <!-- Fin Modal content -->
                <div class="contenedor">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Leyenda</th>
                                    <th>Avatar</th>
                                    <th>Modificación</th>
                                    <th>verificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($servicio as $serv)
                                    <tr>
                                        <td class="filas-tabla">
                                            @if ($serv->image_url)
                                                <img src="{{ asset('storage/' . $serv->image_url) }}"
                                                    alt="Imagen cargada" class="width">
                                            @else
                                                {{ $serv->id }}
                                            @endif
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $serv->nombre }}
                                        </td>
                                        <td class="filas-tabla" id="descripcion">
                                            {{ $serv->descripcion }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $serv->leyenda }}
                                        </td>
                                        <td class="filas-tabla">
                                            @if ($serv->avatar)
                                                <img src="{{ asset('storage/' . $serv->avatar) }}" alt="Imagen cargada"
                                                    class="width">
                                            @else
                                                {{ $serv->id }}
                                            @endif
                                        </td>
                                        <td class="filas-tabla">
                                            <a href="{{ route('cservicios.edit', $serv->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    MODIFICAR
                                                </button>
                                            </a>
                                        </td>
                                        <td class="filas-tabla">
                                            <a href="{{ route('mostrarprod', $serv->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    PRODUCTOS
                                                </button>
                                            </a>
                                        </td>

                                        <td class="filas-tabla">
                                            <form class="eli" action="{{ route('cservicios.delete', $serv->id) }}"
                                                class="formulario-eliminar" id="formulario-eliminar" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn-eliminar" type="submit"></button>
                                            </form>
                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
                <div class="paginate">
                    {{ $servicio }}
                </div>

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
</x-app-layout>
