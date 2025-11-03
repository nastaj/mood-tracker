const tabs = document.querySelectorAll(".tab-btn");
const contents = document.querySelectorAll(".tab-content");

const paymentDetailsForm = document.getElementById('payment-details-form');
const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const email = document.getElementById('email');
const address = document.getElementById('address');
const paymentMethod = document.getElementById('payment-method');
const paymentDetails = document.getElementById('payment-details');

const deleteModal = document.getElementById('deleteModal');
const confirmDeleteBtn = document.getElementById('confirmDelete');
const cancelDeleteBtn = document.getElementById('cancelDelete');
const passwordInput = document.getElementById('delete-account-password');

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
        tabs.forEach(t => t.classList.remove("active", "text-blue-600", "border-b-2", "border-blue-600"));
        tab.classList.add("active", "text-blue-600", "border-b-2", "border-blue-600");
        contents.forEach(c => c.classList.add("hidden"));
        document.getElementById(tab.dataset.tab).classList.remove("hidden");
    });
});

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
        } else {
            return;
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

function toggleDeleteModal() {
    deleteModal.classList.toggle('hidden');
}

async function deleteAccount() {
    const password = passwordInput.value;
    const formData = new FormData();
    formData.append('password', password);
    console.log(password);


    if (!password) {
        Toastify({
            text: "Please enter your password to confirm.",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#f44336",
        }).showToast();
        return;
    }

    try {
        const res = await fetch('./auth/delete_account.php', {
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

            // Redirect after 3 seconds
            setTimeout(() => {
                window.location.href = 'signup.php';
            }, 3000);
        } else {
            Toastify({
                text: "Error deleting account: " + data.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "center",
                backgroundColor: "#f44336",
            }).showToast();
        }
    } catch (error) {
        Toastify({
            text: "Error processing account deletion: " + error.message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "center",
            backgroundColor: "#f44336",
        }).showToast();
    }
}