const cart_list = document.getElementById('cart_list');

$(document).ready(function () {
    showCart();
    if (cart_list) {
        listCart();
    }
});


function listCart() {
    const cart = JSON.parse(localStorage.getItem('cart'));
    const cart_total = document.getElementById('cart_total');
    if (cart) {
        const total = cart.reduce((acc, item) => acc + item.Precio_Producto * item.quantity, 0);
        cart_total.innerHTML = `S/.${total}`;
        cart.forEach(item => {
            const div = document.createElement('div');
            div.classList.add('d-flex', 'align-items-center', 'mb-4');
            div.innerHTML = `
                <div class="me-3 position-relative">
                    <img src="${base_url}/img/productos/${item.Imagen_Producto}" style="height: 96px; width: 96x;" class="img-sm rounded border" />
                </div>
                <div class="text-left">
                <div class="row">
                    <div class="col-10 text-uppercase">
                        <div>${item.Nombre_Producto} (${item.quantity})</div>
                    </div>
                <div class="col-2">
                    <button class="btn btn-danger btn-sm" onclick="removeItem(${item.ID_Producto})">x</button>
                </div>
                    <a href="${base_url}producto/${item.Nombre_Producto}-${item.ID_Producto}" class="nav-link text-uppercase">
                    </a>
                    <div class="price">:S/.${item.Precio_Producto}</div>
                </div>
            `;
            cart_list.appendChild(div);
        });
    }
}

function removeItem(id) {
    const cart = JSON.parse(localStorage.getItem('cart'));
    const new_cart = cart.filter(item => item.ID_Producto != id);
    localStorage.setItem('cart', JSON.stringify(new_cart));
    listCart();
}

function showCart() {
    const cart_container = document.getElementById('cart_container');
    const cart_container_empty = document.getElementById('cart_container_empty');
    const cart = JSON.parse(localStorage.getItem('cart'));
    if (cart) {
        if (cart_container && cart_container_empty) {
            cart_container.style.display = 'block';
            cart_container_empty.style.display = 'none';
        }

    } else {
        if (cart_container && cart_container_empty) {
            cart_container.style.display = 'none';
            cart_container_empty.style.display = 'block';
        }

    }
}