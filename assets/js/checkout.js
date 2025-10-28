const paymentDetailsForm = document.getElementById('payment-details');

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