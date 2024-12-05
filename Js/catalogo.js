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
            newCard.onclick = function () {
                location.href = "ficheroPlanta.php?id=" + planta.id_arbol;
            }
            cardContainer.appendChild(newCard);
        });
    });
}