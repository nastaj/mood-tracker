import showToast from "./toast";

const paymentDetailsForm = document.getElementById('payment-details-form');
const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const email = document.getElementById('email');
const address = document.getElementById('address');
const paymentMethod = document.getElementById('payment-method');
const paymentDetails = document.getElementById('payment-details');
const orderBtn = document.getElementById('order-btn');

function clearErrors() {
    document.querySelectorAll(".error-text").forEach(el => el.textContent = "");
}

document.addEventListener('DOMContentLoaded', async function () {
    try {
        const res = await fetch('./api/customer/get_customer_details.php');
        const data = await res.json();

        if (data.success) {
            const customer = data.customer;
            firstName.value = customer.first_name;
            lastName.value = customer.last_name;
            email.value = customer.email;
            address.value = customer.address;
            paymentMethod.value = customer.payment_method;
            paymentDetails.value = customer.payment_details;
        }
    } catch (error) {
        console.error("Error fetching customer details:", error);
    }
});

paymentDetailsForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    try {
        const formData = new FormData(paymentDetailsForm);

        const res = await fetch('./api/customer/save_customer_details.php', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.success) {
            clearErrors();
            showToast("success", data.message);
        } else {
            // Clear previous error messages
            clearErrors();
            // Display new error messages
            for (const field in data.errors) {
                const errorSpan = document.getElementById(`error-${field}`);
                if (errorSpan) {
                    errorSpan.textContent = data.errors[field];
                }
            }
        }
    } catch (error) {
        showToast("error", error.message);
    }
});
orderBtn.addEventListener('click', createOrder);

async function createOrder() {
    const res = await fetch('./api/orders/create_order.php', {
        method: 'POST'
    });

    const data = await res.json();

    if (data.success) {
        showToast('success', data.message);

        // Clear cart UI
        const cartItemsContainer = document.getElementById('cart-items');
        const cartCount = document.getElementById('cart-count');
        cartCount.textContent = '0';
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
    } else {
        showToast('error', data.message);
    }
}
