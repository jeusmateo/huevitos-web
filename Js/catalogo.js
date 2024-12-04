const ruta_imagenes = './data/';

window.onload = function () {
    cargarPlantas("");
};

function buscarPlantas(event) {
    event.preventDefault();
    const searchTerm = document.getElementById('barrabusqueda').value.trim();
    cargarPlantas(searchTerm);
}

function cargarPlantas(searchTerm) {
    const url = searchTerm ? `Php/leer.php?search=${encodeURIComponent(searchTerm)}` : "Php/leer.php";
    ejecutarPeticion(url, function (xhttp) {
        const listaPlantas = JSON.parse(xhttp.response);
        const cardContainer = document.getElementById('cardContainer');
        cardContainer.innerHTML = "";
        listaPlantas.forEach(function (planta) {
            const newCard = document.createElement('div');
            newCard.classList.add('card');
            const image = document.createElement('img');
            image.setAttribute("src", ruta_imagenes + planta.nombre_imagen);
            image.setAttribute("width", "270px");
            image.setAttribute("height", "150px");
            image.setAttribute("alt", planta.nombre_cientifico);
            const plantName = document.createElement('h3');
            plantName.textContent = planta.nombre_cientifico;
            newCard.appendChild(image);
            newCard.appendChild(plantName);
            cardContainer.appendChild(newCard);
        });
    });
}

function ejecutarPeticion(url, accion) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            accion(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function CardInfo(title, image) {
    this.title = title;
    this.image = image;

    this.saveCardInfo = alertCardInfo;

    console.log("Objeto Carta creado");
    console.log(this);
}

function alertCardInfo() {
    console.log("Informacion de carta establecida");
    alert("Titulo: " + this.title + " Imagen: " + this.image);
}

var myCard;
var cardList = [];

function addCard() {
    const newCard = document.createElement('div');
    newCard.classList.add('card');//agregar clase card a la nueva carta

    var image = document.createElement('img');
    image.setAttribute("src", "Recursos/img/houseplant-7367379_1280.jpg");
    image.setAttribute("width", "270px");
    image.setAttribute("height", "150px");
    image.setAttribute("alt", "Flower");

    var plantName = document.createElement('h3');
    plantName.textContent = 'Carta';

    newCard.appendChild(image);
    newCard.appendChild(plantName);

    document.getElementById('cardContainer').appendChild(newCard);
}

function addCategory() {
    //<input type="button" value="Default" class="botonSeccion"></button>
    const newCategory = document.createElement('input');
    newCategory.classList.add('botonSeccion');

    newCategory.setAttribute("type", "button");
    newCategory.setAttribute("value", "Default");

    document.getElementById('seccionScroller').appendChild(newCategory);

}