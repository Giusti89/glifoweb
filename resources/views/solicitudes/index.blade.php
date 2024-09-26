<x-app-layout>
    <link rel="stylesheet" href="./css/clientes.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitudes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <x-layouts.butonCrear contenido="Nueva Solicitud" enlace="{{ route('nsolicitud') }}">
                    </x-layouts.butonCrear>

                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Concepto</th>
                                <th>Fecha de la petición</th>
                                <th>Servicio</th>
                                <th>Estado</th>
                                <th>Modifica</th>
                                <th>Accion</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitud as $soli)
                                <tr>
                                    <td class="filas-tabla">
                                        {{ $soli->cliente->nombre }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $soli->concepto }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $soli->created_at }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $soli->servicio->nombre }}
                                    </td>
                                    <td class="filas-tabla">
                                        @if ($soli->realizado == 0)
                                            Pendiente
                                        @else
                                            Realizada
                                        @endif
                                    </td>
                                    <td class="filas-tabla">
                                        @if ($soli->realizado == 0)
                                            <a href="{{ route('editarsolicitud', $soli->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    MODIFICAR
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('editarsolicitud', $soli->id) }}">

                                                <button type="button" class="btn-modificar">
                                                    MODIFICAR
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="filas-tabla">
                                        @if ($soli->realizado == 0)
                                            <a href="{{ route('detalle', $soli->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    Llenar
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('pdf', $soli->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    Verificar
                                                </button>
                                            </a>
                                        @endif

                                    </td>
                                    <td class="filas-tabla">
                                        <form class="eli" action="{{ route('solicitud.delete', $soli->id) }}"
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
                <div class="paginate">
                    {{ $solicitud }}
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
