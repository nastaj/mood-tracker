const paymentDetailsForm = document.getElementById('payment-details-form');
const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const email = document.getElementById('email');
const address = document.getElementById('address');
const paymentMethod = document.getElementById('payment-method');
const paymentDetails = document.getElementById('payment-details');

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
            Toastify({
                text: data.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#4CAF50",
            }).showToast();
        } else {
            Toastify({
                text: "Error saving payment details: " + data.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#f44336",
            }).showToast();
        }
    } catch (error) {
        Toastify({
            text: "Error processing payment details: " + error.message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#f44336",
        }).showToast();
    }
});