<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Glifoo</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="icon" href="../../img/logos/Boton.ico">
    <link rel="stylesheet" href="{{ $url ?? '' }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</head>

<body>
    <header class="main-header">
        <a class="main-logo" href="#">
            <img src="../../img/logos/GlifooComunicacion.png" alt="">
        </a>
    </header>
    <div>
        @if (session('msj') == 'eliminado')
        <script>
            Swal.fire({
                title: "Eliminado",
                text: "Su archivo ha sido eliminado.",
                icon: "success"
            });
        </script>
    @endif

    @if (session('msj') == 'create')
        <script>
            Swal.fire({
                title: "Exito",
                text: "Su accion ha sido realizada.",
                icon: "success"
            });
        </script>
    @endif

    @if (session('msj') == 'modify')
    <script>
        Swal.fire({
            title: "Exito",
            text: "Su archivo ha sido modificado.",
            icon: "success"
        });
    </script>
@endif

    @if (session('msj') == 'imposible')
    <script>
        Swal.fire({
            title: "Error",
            text: "No se puede realizar la solicitud",
            icon: "warning"
        });
    </script>
@endif
        <div class="conterrores">
            @include('fragments._errors-form')
        </div>

        {{ $slot }}






        <footer>
            <div class="pie">
                <div class="caja">
                    <a href="#"><img src="../../img/logos/LogoGlifoo.png" alt=""></a>
                </div>

            </div>
        </footer>
        <div class="final">
            <div class="copy">
                <a href="{{ route('inicio') }}">
                    <p>©2023 Glifoo - Comunicación Digital</p>
                </a>
                <div>
                    <a href="{{ route('privacidad') }}">Políticas de privacidad</a>
                </div>
            </div>
        </div>
        <script src="//web.webformscr.com/apps/fc3/build/loader.js" async
            sp-form-id="292bf1e2f393a01757bf824e028c6d8104ef8f0752c5d5059a2b4a920f18ba26"></script>
        <script src="{{ $scrip ?? '' }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>
