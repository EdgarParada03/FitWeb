function calcularFechaFin() {
    var inicio = new Date(document.getElementById('fecha_inicio').value);
    var plan = document.getElementById('plan').value;
    var duracion;

    switch (plan) {
        case 'basico':
            duracion = 7;
            break;
        case 'general':
            duracion = 15;
            break;
        case 'elite':
            duracion = 30;
            break;
    }

    var fin = new Date(inicio);
    fin.setDate(inicio.getDate() + duracion);

    document.getElementById('fecha_fin').value = fin.toISOString().split('T')[0];
}

function establecerFechaMinima() {
    var fechaHoy = new Date();
    var dia = String(fechaHoy.getDate()).padStart(2, '0');
    var mes = String(fechaHoy.getMonth() + 1).padStart(2, '0'); // Los meses en JavaScript empiezan desde 0
    var ano = fechaHoy.getFullYear();

    fechaHoy = ano + '-' + mes + '-' + dia;
    document.getElementById('fecha_inicio').min = fechaHoy;
}

window.onload = establecerFechaMinima;


function validarDocumento() {
    var documento = document.getElementById("documento").value;
    // Realizar solicitud al servidor para validar el documento
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "validar_documento.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var respuesta = xhr.responseText;
                document.getElementById("mensaje").textContent = respuesta;
            } else {
                console.error("Error en la solicitud");
            }
        }
    };
    xhr.send("documento=" + documento);
}
