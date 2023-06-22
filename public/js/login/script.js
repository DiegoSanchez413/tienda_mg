const inputs = document.querySelectorAll(".input");


function addcl() {
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl() {
	let parent = this.parentNode.parentNode;
	if (this.value == "") {
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});



const formulario = $("#form_login");
formulario.submit(function (e) {
    e.preventDefault();
    const dato = new FormData(formulario[0]);
    $.ajax({
        type: "post",
        url: base_url + "/verificar_acceso_usuarios",
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
                    timer: 3000,
                    showConfirmButton: false,
                });
                location.href = base_url + 'inicio'; //redirige a la pagina
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