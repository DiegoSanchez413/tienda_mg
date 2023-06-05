const cart_list = document.getElementById('cart_list');
const cart_container = document.getElementById('cart_container');
const cart_container_empty = document.getElementById('cart_container_empty');
const product_list = document.getElementById('product-list');
const brand_list = document.getElementById('brand-list');

$(document).ready(function () {
    if (product_list) {
        listBrands();
        listProducts();

    }
    if (cart_container && cart_container_empty) {
        showCart()
    };
    if (cart_list) {
        listCart();
    }
});


function listCart() {
    const cart = JSON.parse(localStorage.getItem('cart'));
    const cart_total = document.getElementById('cart_total');
    const url = window.location.href;
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

    const cart = JSON.parse(localStorage.getItem('cart'));
    if (cart) {
        cart_container.style.display = 'block';
        cart_container_empty.style.display = 'none';

    } else {
        cart_container.style.display = 'none';
        cart_container_empty.style.display = 'block';

    }
}

async function listProducts() {
    try {
        const response = await fetch("/product/list", {
            method: 'POST',
            mode: 'no-cors',
            headers: {
                "Content-Type": "application/json"
            },
        });
        const data = await response.json();
        buildCard(data.productos);
    } catch (error) {
        console.log(error);
    }
}

async function listBrands() {
    try {
        const response = await fetch("/brand/list", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });
        const data = await response.json();
        await buildBrand(data);
    } catch (error) {
        console.log(error);
    }
}

async function buildBrand(brands) {
    brands.forEach(brand => {
        brand_list.innerHTML += `
        <div class="form-check">
            <input class="form-check-input" name="brand" type="checkbox" value="${brand.Marca_Producto}" id="${brand.Marca_Producto}" />
            <label class="form-check-label" for="${brand.Marca_Producto}">${brand.Marca_Producto}</label>
        </div>
        `;
    })

    const brand_checkboxes = document.querySelectorAll('input[name="brand"]');
    brand_checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', async function () {
            const checked = Array.from(brand_checkboxes).filter(i => i.checked).map(i => i.value);
            if (checked.length > 0) {
                let brand = checked
                // if local storage with key filters exists, update it else create it
                if (localStorage.getItem('filters')) {
                    localStorage.setItem('filters', JSON.stringify({
                        brand: brand
                    }));
                } else {
                    localStorage.setItem('filters', JSON.stringify({
                        brand: brand
                    }));
                }

                await filterProducts();
            }
        })
    })

}

async function filterProducts() {
    try {
        let formData = new FormData();
        formData.append('filters', JSON.stringify(JSON.parse(localStorage.getItem('filters'))));

        const response = await fetch("/product/list", {
            method: 'POST',
            mode: 'no-cors',
            headers: {
                "Content-Type": "application/json"
            },
            body: formData
        });
        const data = await response.json();
        buildCard(data.productos);
    } catch (error) {

    }
}



function buildCard(products) {
    product_list.innerHTML = '';
    products.forEach(product => {
        product_list.innerHTML += `
        <div class="row justify-content-center mb-3" >
            <div class="col-md-12">
            <div class="card shadow-0 border rounded-3 product" onCLick="location.href='${base_url}producto/${product.Nombre_Producto}-${product.ID_Producto};'">
        <div class="card-body">
            <div class="row">
            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                <img src="img/productos/${product.Imagen_Producto}" class="img-fluid text-center" style="max-height: 150px; object-fit: contain; width: 100%;"
                />
                <a href="#!">
                    <div class="hover-overlay">
                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6">
                <h5> ${product.Nombre_Producto} </h5>
                <div class="d-flex flex-row">
                <div class="text-danger mb-1 me-2">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <span>310</span>
                </div>
                <div class="mt-1 mb-0 text-muted small">
                <span> Marca: ${product.Nombre_Producto}</span><br>
                <!-- <span class="text-primary"> • </span>
                <span>Light weight</span>
                <span class="text-primary"> • </span>
                <span>Best finish<br /></span> -->
                </div>
                <!-- <div class="mb-2 text-muted small">
                <span>Unique design</span>
                <span class="text-primary"> • </span>
                <span>For men</span>
                <span class="text-primary"> • </span>
                <span>Casual<br /></span>
                </div> -->
                <p class="text-truncate mb-4 mb-md-0">
                 ${product.Descripcion_Producto}
                </p>
            </div>
            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                <h4 class="mb-1 me-1"> S/.${product.Precio_Producto}</h4>
                <span class="text-danger"><s>$20.99</s></span>
                </div>
                <h6 class="text-success">Free shipping</h6>
                <div class="d-flex flex-column mt-4">
                <button class="btn btn-primary btn-sm" type="button">Detalles</button>
                <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Agregar al carrito
                </button>
                </div>
            </div>
            </div>
        </div>
        </div>
            </div>
        </div>
    `;
    });

}