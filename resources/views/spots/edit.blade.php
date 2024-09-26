<x-layouts.menus url="../../css/spotcreate.css">
    <div class="titulo">
        <h3>Editar Spot</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">
        <form class="fmdatos" action={{ route('spots.update', $publicidad->id) }} method="post"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <label for="">Imagen Actual:</label>
            <img src="{{ asset('storage/' . $publicidad->boton) }}" alt="Imagen cargada" class="width">

            <label for="">Tipo de Publicidad:</label>
            <div class="selectores">
                <select id="publicidad" name="publicidad" class="selector">
                    <option value=""></option>
                    @foreach ($publi as $ad)
                        <option value="{{ $ad->id }}" {{ $advertisingId == $ad->id ? 'selected' : '' }}>
                            {{ $ad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <label for="">Boton del spot:</label>
            <input id="file_input" type="file" name="image" accept="image/jpeg/png/webp"><br>

            {{-- @if ($publicidad->estado == 1) --}}
                <label for="css">Estado de la publicidad</label>
                <div class="publicad">
                    <input type="radio" id="activo" name="activo" value="1"
                        {{ $publicidad->estado == '1' ? 'checked' : '' }}>
                    <label for="activo">Publicado</label><br>

                    <input type="radio" id="inactivo" name="activo" value="0"
                        {{ $publicidad->estado == '0' ? 'checked' : '' }}>
                    <label for="inactivo">Quitar de publicación</label><br>
                </div>
            {{-- @endif --}}



            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                <a href="{{ route('spots.index') }}">
                    <button data-modal-toggle="defaultModal" type="button" class="close">Cancelar</button>
                </a>
            </div>
        </form>

    </div>

</x-layouts.menus>
