document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();
    document.getElementById("successMessage").style.display = "block";
    setTimeout(function() {
        document.getElementById("successMessage").style.display = "none";
    }, 5000);
});

document.getElementById("viewMessagesBtn").addEventListener("click", function() {
    document.getElementById("messagesModal").style.display = "block";
});

document.getElementById("viewVisitasBtn").addEventListener("click", function() {
    document.getElementById("visitasModal").style.display = "block";
});

document.querySelectorAll(".close-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
        document.getElementById("messagesModal").style.display = "none";
        document.getElementById("visitasModal").style.display = "none";
    });
});

window.addEventListener("click", function(event) {
    if (event.target === document.getElementById("messagesModal") || event.target === document.getElementById("visitasModal")) {
        document.getElementById("messagesModal").style.display = "none";
        document.getElementById("visitasModal").style.display = "none";
    }
});
