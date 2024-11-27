// Obtén el botón
let subir = document.getElementById("botonSubir");

// Agrega el evento de scroll usando addEventListener
window.addEventListener("scroll", scrollFunction);

function scrollFunction() {
    // Usa document.documentElement.scrollTop para comprobar la posición del scroll
    if (document.documentElement.scrollTop > 20 || document.body.scrollTop > 20) {
        subir.style.display = "block";
    } else {
        subir.style.display = "none";
    }
}

// Cuando el usuario hace clic en el botón, vuelve al inicio de la página
function regresarArriba() {
    document.documentElement.scrollTo({ top: 0, behavior: 'smooth' }); // Desplazamiento suave
}

const zoomContainers = document.querySelectorAll('.zoom-container');
const zoomImages = document.querySelectorAll('.imagen-zoomable');

zoomImages.forEach((image, index) => {
    image.addEventListener('click', () => {
        zoomContainers[index].style.display = 'flex';
    });
});

const closeBtns = document.querySelectorAll('.close-btn');

closeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        zoomContainers.forEach(container => {
            container.style.display = 'none';
        });
    });
});

// Seguimiento de visitas con Local Storage
const visitas = JSON.parse(localStorage.getItem("visitas")) || [];
visitas.push({ fecha: new Date().toLocaleString(), pagina: "Inicio" });
localStorage.setItem("visitas", JSON.stringify(visitas));

// Función para descargar el seguimiento en PDF
function descargarPDF() {
    const { jsPDF } = window.jspdf; // jsPDF debe estar importado en tu HTML
    const doc = new jsPDF();

    doc.text("Seguimiento de Visitas", 10, 10);
    visitas.forEach((visita, index) => {
        doc.text(`${index + 1}. Fecha: ${visita.fecha}, Página: ${visita.pagina}`, 10, 20 + index * 10);
    });

    doc.save("seguimiento_visitas.pdf");
}

// Subir archivo
function subirArchivo() {
    const archivo = document.getElementById("archivo").files[0];
    if (archivo) {
        alert(`Archivo "${archivo.name}" subido exitosamente.`);
    } else {
        alert("Por favor selecciona un archivo para subir.");
    }
}

