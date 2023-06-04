const formulario = $("#form_loginC");
formulario.submit(function (e) {
    e.preventDefault();
    const dato = new FormData(formulario[0]);
    $.ajax({
        type: "post",
        url: base_url + "/verificar_acceso_clientes",
        data: dato,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.error == "") {
                // swal.fire({
                //     title: response.ok,
                //     html: "¡Sigamos mejorando nuestra comunidad!",
                //     icon: "success",
                //     timer: 3000,
                //     showConfirmButton: false,
                // });
                saveUserInStorage(response.user);
                // location.href = base_url + 'inicio';
                location.href = base_url;
            } else {
                swal.fire({
                    title: "¡Error!",
                    html: response.error,
                    icon: "error",
                    showConfirmButton: true,
                });
            }
        }
    });
});


// function saveUserInStorage(user) {
//     localStorage.setItem('user', JSON.stringify(user));
//     client_fullname.innerHTML = simplifyName(user.Nombre_Cliente) + ' ' + simplifyName(user.Apellido_Cliente);
// }
