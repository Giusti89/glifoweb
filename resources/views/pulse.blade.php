<x-layouts.principal titulo="Pulse" url="./css/pulsee.css">
    <div class="contenedor">
        <div class="cabz">
            <div class="artz" oncontextmenu='return false'>
                <img src="./img/logos/plus.png" alt="">
                <p>Nuestro principal objetivo es elevar los estándares de la comunicación digital a través de soluciones 
                personalizadas y de alta calidad. Buscamos establecer relaciones sólidas y a largo plazo con nuestros clientes, 
                basadas en la confianza y la entrega constante de resultados excepcionales. Nos esforzamos por crear estrategias y campañas que no solo cumplan con las expectativas, 
                sino que las superen, impulsando el crecimiento y la visibilidad de nuestros socios comerciales.</p>

            </div>
            <div class="vid">

            </div>

        </div>
        <div class="titulo">
            <h2>Nuestros clientes <b>Pulse</b> </h2>
        </div>
        <div class="capa2">
            <div class="fotos" oncontextmenu='return false'>
                @foreach ($boton as $cuadro)
                    @if ($cuadro->estado == 1)
                        <div class="imgpub">
                            <a href="{{ route('publicidad.show', $cuadro->slug) }}">
                                <img class="imgMuestraAvatar" src="/storage/{{ $cuadro->boton }}" alt="">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="vid2"></div>
        </div>
    </div>
</x-layouts.principal>
