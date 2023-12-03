var intentosFallidos = {};

function LogIn() {
    
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    alert("Entró a JS");
    if (intentosFallidos[username] && intentosFallidos[username] >= 3) {
        alert("Usuario bloqueado. Por favor, contacte al administrador.");
        return;
    }

    var url = "../php/index.php";

    var datos = {
        username: username,
        password: password
    };

    var configuracion = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos)
    };
    
    fetch(url, configuracion)
        .then(response => response.json())
        .then(data => {
        console.log('Success: ', data);
        }).catch(error => {
            console.error('Error:', error);
        });
}

document.getElementById("bIngresar").onclick = function(){LogIn();};