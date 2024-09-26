const listaServicios = document.getElementById("listaServicios");
const acordeon = document.getElementById("muestrAcordeon");
let serv = [];
let opcionservicios;
let desplegable;
var contador = 1;
let eleccion;

class servicio {
    constructor(nombre, foto, imagenes) {
        this.nombre = nombre;
        this.foto = foto;
        this.imagenes = [];
    }
}
let fotografia = new servicio("Fotografía", "./img/portfolios/fotografia.webp");

let diseñoGraf = new servicio(
    "Diseño Gráfico",
    "./img/portfolios/diseGrafico.webp"
);
let marketingDigital = new servicio(
    "Marketing Digital",
    "./img/portfolios/marketingDigital.webp"
);


let prodAudiovisuak = new servicio(
    "Producción Audiovisual",
    "./img/portfolios/prodVisual.webp"
);
let sisInformaticos = new servicio(
    "Sistemas Informáticos",
    "./img/portfolios/sisInformaticos.webp"
);
let direEstilo = new servicio(
    "Dirección de Estilo",
    "./img/portfolios/asesoria.webp"
);

diseñoGraf.imagenes.push({ direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" });

marketingDigital.imagenes.push({ direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" });

fotografia.imagenes.push({ direccion: "./img/portfolios/GrillHouse.webp", nombre: "Grill House", link: "./grillHouse" }, { direccion: "./img/portfolios/VariVera.webp", nombre: "Vari Vera", link: "./vari" }, { direccion: "./img/portfolios/catalogo.webp", nombre: "Catálogo", link: "./cross" });

prodAudiovisuak.imagenes.push({ direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" });

sisInformaticos.imagenes.push({ direccion: "./img/portfolios/cepshir.webp", nombre: "Pagina web - Cepshir", link: "./sistemasport" }, { direccion: "./img/portfolios/HotelNelo.webp", nombre: "Hotel don Nelo", link: "./sisHos" }, { direccion: "./img/portfolios/ITA.webp", nombre: "Sistema Administrativo", link: "./sisadmin" });

direEstilo.imagenes.push({ direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" }, { direccion: "./img/portfolios/PortfolioCons.gif", nombre: "Próximamente", link: "#" });

serv.push(
    fotografia,
    sisInformaticos,
    diseñoGraf,
    marketingDigital,
    prodAudiovisuak,
    direEstilo,


);

function iniciarVentana() {
    acordeon.style.display = "none";
    serv.forEach((servicio) => {
        opcionservicios = ` 
        <div class="cajaImg" id="${servicio.nombre}">
            <img src=${servicio.foto} alt="" class="redondo">
            <label for="">${servicio.nombre}</label>
        </div> 
        `;
        listaServicios.innerHTML += opcionservicios;

        btnFoto = document.getElementById("Fotografía");
        btnDiseGraf = document.getElementById("Diseño Gráfico");
        btnMarkDig = document.getElementById("Marketing Digital");
        btnProdVisual = document.getElementById("Producción Audiovisual");
        btnSis = document.getElementById("Sistemas Informáticos");
        btndirEstilo = document.getElementById("Dirección de Estilo");
    });
    btnFoto.addEventListener("click", mostrarFoto);
    btnDiseGraf.addEventListener("click", mostrarDisgraf);
    btnMarkDig.addEventListener("click", mostrarMark);
    btnProdVisual.addEventListener("click", mostrarProd);
    btnSis.addEventListener("click", mostrarSis);
    btndirEstilo.addEventListener("click", mostrarEstilo);
}

function mostrarDisgraf() {

    acordeon.style.display = "block";
    contador++;
    acordeon.innerHTML = "";
    diseñoGraf.imagenes.forEach(elemento => {

        desplegable = ` 
            <li>
                <h4>${elemento.nombre}</h4>
                <a href="${elemento.link}"><img src="${elemento.direccion}" /></a>
            </li>
        `;
        acordeon.innerHTML += desplegable;
    })


}

function mostrarMark() {

    acordeon.style.display = "block";
    contador++;
    acordeon.innerHTML = "";
    marketingDigital.imagenes.forEach(elemento => {

        desplegable = ` 
            <li>
                <h4>${elemento.nombre}</h4>
                <a href="#"><img src="${elemento.direccion}" /></a>
            </li>
        `;
        acordeon.innerHTML += desplegable;
    });


}

function mostrarFoto() {

    acordeon.style.display = "block";
    contador++;
    acordeon.innerHTML = "";
    fotografia.imagenes.forEach(elemento => {

        desplegable = ` 
            <li>
                <h4>${elemento.nombre}</h4>
                <a href="${elemento.link}"><img src="${elemento.direccion}" /></a>
            </li>
        `;
        acordeon.innerHTML += desplegable;
    })

    contador++;

}

function mostrarProd() {

    acordeon.style.display = "block";
    contador++;
    acordeon.innerHTML = "";
    prodAudiovisuak.imagenes.forEach(elemento => {

        desplegable = ` 
            <li>
                <h4>${elemento.nombre}</h4>
                <a href="#"><img src="${elemento.direccion}" /></a>
            </li>
        `;
        acordeon.innerHTML += desplegable;
    })



}

function mostrarSis() {

    acordeon.style.display = "block";
    contador++;
    acordeon.innerHTML = "";
    sisInformaticos.imagenes.forEach(elemento => {

        desplegable = ` 
            <li>
                <h4>${elemento.nombre}</h4>
                <a href="${elemento.link}"><img src="${elemento.direccion}" /></a>
            </li>
        `;
        acordeon.innerHTML += desplegable;
    })




}

function mostrarEstilo() {

    acordeon.style.display = "block";
    contador++;
    acordeon.innerHTML = "";
    direEstilo.imagenes.forEach(elemento => {

        desplegable = ` 
            <li>
                <h4>${elemento.nombre}</h4>
                <a href="#"><img src="${elemento.direccion}" /></a>
            </li>
        `;
        acordeon.innerHTML += desplegable;
    })




}
window.addEventListener("load", iniciarVentana);