$id = $('#id_usuario').val();
var perfil = document.getElementById('perfil_user_sesion');
$(document).ready(function () {
    $.post(base_url + "/getUsuario-x-id", { id: $id },
        function (data, textStatus, jqXHR) 
        {
            $('#nombre_user_sesion').html(data.data[0].Nombre_Usuario);
            if (data.data[0].foto == "") {
                perfil.innerHTML = '<img class="img-profile rounded-circle" src="https://th.bing.com/th/id/OIP.-LPABXMH-PmgsmQqwgvKaAHaHa?pid=ImgDet&rs=1">';
            } else {
                perfil.innerHTML = '<img class="img-profile rounded-circle" src="'+base_url+'/imagenes/fotos_perfil/' + data.data[0].foto + '" alt="Perfil">';
            }
        },
        "json"
    );
});