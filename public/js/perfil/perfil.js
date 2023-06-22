//MOSTRAR USUARIO
$id = $('#id_usuario').val();
$(document).ready(function () {
    $.post(base_url + "mostrar_datos", { id: $id },
        function (data, textStatus, jqXHR) {
            $('#nombre_user').html(data.data[0].Nombre_Usuario);
            $('#nombre').val(data.data[0].Nombre_Usuario);
            $('#usuario').val(data.data[0].Correo_Usuario);
            $('#rol').val(data.data[0].Nombre_Rol);
          /*  if (data.data[0].firma != "") {
                $('#firma_digital').attr('src', ruta + '/recursos/img/employes_firmas/' + data.data[0].firma);
            } else {
                $('#texto-firma').html('No cuenta con Firma Digital');
            }*/
            if (data.data[0].foto != "") {
                $('#perfil').attr('src', base_url + '/imagenes/fotos_perfil/' + data.data[0].foto);
            } else {
                $('#texto-perfil').html('No cuenta con Foto de Perfil');
            } 

        },
        "json"
    );
});


// EDITAR DATOS

const editardatos = $('#editardatos');
$(editardatos).submit(function (e) {
    e.preventDefault();
    const dato_orden = new FormData(editardatos[0]);
    $.ajax({
        type: "post",
        url: base_url + "actualizarDatosPersonales",
        data: dato_orden,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.error == "") {
                swal.fire({
                    title: response.ok,
                    html: "¡Sigamos mejorando nuestra comunidad!",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
                setTimeout(function () {
                    location.href = base_url + "/Perfil";
                }, 1800)
            } else {
                swal.fire({
                    title: "¡ERROR!",
                    html: response.error,
                    icon: "error",
                    showConfirmButton: true,
                });
            }
        }
    });
});


//actualizar_foto
function actualizar_foto() {
    $('#modal_foto').modal('show');
}
const form_foto = $('#form_foto');
$(form_foto).submit(function (e) {
    e.preventDefault();
    const dato_foto = new FormData(form_foto[0]);
    dato_foto.append('ID_Usuario', $id)
    $.ajax({
        type: "post",
        url: base_url + "actualizar_foto",
        data: dato_foto,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.error == "") {
                swal.fire({
                    title: response.ok,
                    html: "¡Sigamos mejorando nuestra comunidad!",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
                setTimeout(function () {
                    location.href = base_url + "/Perfil";
                }, 1800)
            } else {
                swal.fire({
                    title: "¡ERROR!",
                    html: response.error,
                    icon: "error",
                    showConfirmButton: true,
                });
            }
        }
    });

});

//MOSTRAR IMAGEN Foto
document.getElementById("foto").onchange = function (e) {
    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = function () {
        let preview = document.getElementById('prev_foto'),
            image = document.createElement('img');
        image.src = reader.result;
        image.style.width = '300px';
        preview.innerHTML = '';
        preview.append(image);
    };
}

/**actualizar contraseña */
const formulario = $("#form_password");
formulario.submit(function (e) {
	e.preventDefault();
	const dato = new FormData(formulario[0]);
	$.ajax({
		type: "post",
		url: base_url + "actualizar_contraseña",
		data: dato,
		dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		success: function (response) {
			if (response.error == "") {
				swal.fire({
                    title: response.ok,
                    html: "¡Sigamos mejorando nuestra comunidad!",
                    icon: "success",
                    timer: 1000,
                    showConfirmButton: false,
                });
                
                setTimeout(function () {
                    location.href = base_url + "/Perfil";
                }, 1800)
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