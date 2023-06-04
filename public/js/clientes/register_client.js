const client_fullname = document.getElementById('client_fullname')

$(document).ready(function () {
    setUserData();

});

const formClientet = $('#formClientet');
//Registrar y editar cliente (envio de datos al servidor)
$(formClientet).submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: base_url + "/registro_clientest",
        data: new FormData(formClientet[0]), //capturamos los datos del formClientet para enviar al controlador
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false, //para que reconozca el ajax
        success: function (response) {
            console.log(response);
            if (response.ok) {
                formClientet[0].reset();
                // Swal.fire({
                //     title: response.ok,
                //     html: "¡Sigamos mejorando nuestra comunidad!",
                //     icon: "success",
                //     timer: 3000,
                //     showConfirmButton: false,
                // });
                saveUserInStorage(response.user);
                location.href = base_url;
            } else {
                const error = Object.keys(response);
                const errorList = error.map(key => response[key]);
                const html_list = errorList.map(error => `<li>${error}</li>`).join('');
                Swal.fire({
                    title: "¡Error!",
                    html: html_list,
                    icon: "error",
                    showConfirmButton: true,
                });
            }
        },
        error: function () {
            Swal.fire({
                title: '¡ERROR 500!',
                html: 'error de servidor interno',
                icon: 'error',
                showConfirmButton: true
            });
        }
    });

});

function saveUserInStorage(user) {
    localStorage.setItem('user', JSON.stringify(user));
    client_fullname.innerHTML = simplifyName(user.Nombre_Cliente) + ' ' + simplifyName(user.Apellido_Cliente);
}

function setUserData() {
    const user = JSON.parse(localStorage.getItem('user'));
    if (user) {
        client_fullname.innerHTML = simplifyName(user.Nombre_Cliente) + ' ' + simplifyName(user.Apellido_Cliente)
    }
}

function simplifyName(name) {
    return name.split(' ')[0];
}