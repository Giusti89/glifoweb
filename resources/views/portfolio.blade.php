<x-layouts.principal titulo="Servicios" url="./css/portfolio.css">
    <div class="bannerPrincipal">
        <div class="circulo">
            <p>Nuestros <br> proyectos</p>
        </div>
    </div>

    <div class="tituloo">
        <h2>Seleccione uno de nusetros proyectos</h2>
    </div>

    <div id="listaServicios" class="proyecto">
        @foreach ($avatars as $ava)
        <div class="cajaImg" id="${servicio.nombre}">
            <img src="/storage/app/public/{{ $ava->avatar }}" alt="" class="redondo">
            <label for="">{{$ava->nombre}}</label>
        </div>
        @endforeach
    </div>
    <!--<div class="tituloo">-->
    <!--    <h2>Nuestros proyectos realizados</h2>-->
    <!--</div>-->
    
    <div class="portfolio">
           
        <!--<ul class="acordeon" id="muestrAcordeon">-->
        <!--    <li>-->
        <!--        <h4>-->
        <!--        En construcción-->
        <!--        </h4>-->
        <!--        <a href=""><img src="" /></a>-->
        <!--    </li>    -->
        <!--</ul>-->

    </div>
<script src="./js/portf.js"></script>
</x-layouts.principal>
