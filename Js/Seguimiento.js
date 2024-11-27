// Función para registrar la visita en localStorage
function registrarVisita(pagina) {
    const visitas = JSON.parse(localStorage.getItem("visitas")) || [];
    visitas.push({ fecha: new Date().toLocaleString(), pagina: pagina });
    localStorage.setItem("visitas", JSON.stringify(visitas));
}

// Función para mostrar el historial de visitas
function mostrarVisitas() {
    const visitas = JSON.parse(localStorage.getItem("visitas")) || [];
    const visitasList = document.getElementById("visitasList");
    
    // Limpiar el listado de visitas previas
    visitasList.innerHTML = '';
    
    // Mostrar las visitas almacenadas
    visitas.forEach(visit => {
        const visitItem = document.createElement('div');
        visitItem.textContent = `${visit.fecha} - ${visit.pagina}`;
        visitasList.appendChild(visitItem);
    });

    // Mostrar el modal
    document.getElementById('visitasModal').style.display = 'block';
}

// Agregar un evento al botón para mostrar las visitas
document.getElementById('viewVisitasBtn')?.addEventListener('click', mostrarVisitas);

// Cerrar el modal
document.querySelector('.close-btn')?.addEventListener('click', function() {
    document.getElementById('visitasModal').style.display = 'none';
});

// Registrar la visita actual (ejemplo de uso)
if (document.title) {
    registrarVisita(document.title);
}
