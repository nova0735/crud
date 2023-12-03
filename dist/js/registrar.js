function registrarDatos(){
    var username = document.getElementById("username").value;
    var nombre = document.getElementById("firstName").value;
    var apellido = document.getElementById("lastName").value;

    fetch('../php/registrar.php', {
        method: 'POST', // o 'GET'
        headers: {
            'Content-Type': 'application/json',
            'Access-Control-Allow-Origin': '*',
        },
        body: JSON.stringify({username: username, nombre: nombre, apellido: apellido}),
    })
}

document.getElementById("bIngresar").onclick = function(){registrarDatos();};