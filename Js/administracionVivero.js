window.onload = function () {
    ejecutarPeticion("Php/leer.php", function (xhttp) {
        const listaPlantas = JSON.parse(xhttp.response);

        // fixme
        listaPlantas.forEach(function (element) {
            const card = new CardInfo(element.nombre_cientifico, element.ruta_imagen);
            cardList.push(card);

        });

    });

}
