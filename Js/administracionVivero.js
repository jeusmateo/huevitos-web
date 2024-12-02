window.onload = function () {
    ejecutarPeticion("Php/leer.php", function (xhttp) {
        const respuesta = JSON.parse(xhttp.response);

        console.log(respuesta);
        respuesta.forEach((e)=>console.log(e));

    });

}

function ejecutarPeticion(url, accion) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            accion(this);
        }
    }

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

let myCard;
const cardList = [];

function addCard() {
    const newCard = document.createElement('div');
    newCard.classList.add('card'); //agregar clase card a la nueva carta

    var image = document.createElement('img');
    image.setAttribute("src", "../Recursos/img/houseplant-7367379_1280.jpg");
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