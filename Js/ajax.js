function ejecutarPeticion(url, onSuccess) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            onSuccess();
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
