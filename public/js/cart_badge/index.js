const cart_quantity = document.getElementById('cart_quantity');

$(document).ready(function () {
    setInterval(listenCart, 1000);
});

function listenCart(){
    const cart = JSON.parse(localStorage.getItem('cart'));
    if(cart){
        cart_quantity.innerHTML = cart.length;
        display = cart.length > 0 ? 'block' : 'none';
        cart_quantity.style.display = display;
    }else{
        cart_quantity.style.display = 'none';
    }
}