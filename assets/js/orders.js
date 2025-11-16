const ordersContainer = document.getElementById("orders-container");

async function loadOrders() {
    const res = await fetch('./api/orders/get_orders.php');
    const data = await res.json();
    if (data.success) {
        ordersContainer.innerHTML = data.html;
    }
}

loadOrders();