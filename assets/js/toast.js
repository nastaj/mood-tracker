export default function showToast(type, message, duration = 3000) {
    Toastify({
        text: message,
        duration: duration,
        close: true,
        gravity: "top",
        position: "center",
        style: {
            background: type === "error" ? "linear-gradient(to right, #ff5f5f, #ffcccb)" : "linear-gradient(to right, #00b09b, #96c93e)",
        },
    }).showToast();
}