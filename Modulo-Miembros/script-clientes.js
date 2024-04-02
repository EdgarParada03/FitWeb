function calcularFechaFin() {
    var inicio = new Date(document.getElementById('fecha_inicio').value);
    var plan = document.getElementById('plan').value;
    var duracion;

    switch(plan) {
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