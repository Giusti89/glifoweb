<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/publicidadtienda.css">

    <link rel="icon" href="{{ asset('../../public/storage/' . $logoCliente ?? '') }}">

    <title>{{ $titulo ?? '' }}</title>
</head>

<body>
    <div class="contPrincipal">
        <div class="banerPrincipal" oncontextmenu='return false'>
            <img src="{{ asset('../../public/storage/' . $imagenPrincipal ?? '') }}" alt="{{ $titulo ?? '' }}">
        </div>
        <div class="art">
            <div class="descrip">
                <h1>{{ $tituloArticulo ?? '' }}</h1>
                <p>{{ $textoArticulo ?? '' }}</p>
            </div>
            <div class="redes">
                <div class="conteBotones" oncontextmenu='return false'>
                    
                    @foreach ($redes as $red)
                        <div class="boton">
                            <a href="{{ $red->link }}" target="_blank">
                                <img src="{{ asset('../../public/storage/' . $red->imagen) }}" alt="{{ $red->nombre }}">
                            </a>
                        </div>
                    @endforeach


                </div>
                <div class="rectangulo"></div>
            </div>
        </div>

        <div class="repro">
            <video autoplay="false" controls oncontextmenu='return false'>
                <source src="{{ asset('../../public/storage/' . $videoPrincipal ?? '') }}" type="video/mp4" />
            </video>

        </div>
        <div class="titulo">
            <h1>Tienda</h1>
        </div>
        <div class="conteStore" oncontextmenu='return false'>
            
           
            @foreach ($articulo as $art)
                <div class="item">
                    <img src="{{ asset('../../public/storage/' . $art->ruta) }}" alt="">
                    <h2>{{ $art->nombre }}</h2>
                    <p>{{ $art->descripcion }}</p>
                    <b>{{ $art->costo }}</b>
                </div>
            @endforeach

        </div>
    </div>
</body>

</html>

