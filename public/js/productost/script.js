$(document).ready(function() {
    $.ajax({
        url: '/products',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            response.products.forEach(function(product) {
                var imageUrl = product.Imagen_Producto;
                var productName = product.Nombre_Producto; // Suponiendo que tienes una columna 'name' en tu tabla

                // Genera el HTML para mostrar el producto y su imagen
                var productHtml = '<div class="product">';
                productHtml += '<img src="' + imageUrl + '" alt="' + productName + '">';
                productHtml += '<h3>' + productName + '</h3>';
                productHtml += '</div>';

                // Agrega el producto al catálogo
                $('#product-list').append(productHtml);
            });
        }
    });
});