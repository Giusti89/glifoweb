<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="./img/logos/Boton.ico">
    


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>

</head>
<body class="font-sans antialiased">
    
    <div class="min-h-screen bg-gray-100" >
         <!-- mensajes de confirmacion -->
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

     <!-- mensajes de confirmacion -->
        @include('layouts.navigation')

        <!-- Page Heading -->

       
      



        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @yield('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
