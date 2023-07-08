document.addEventListener("DOMContentLoaded", () => {
    console.log("hello");
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const reserveButton = document.getElementById("reserveButton");

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
            reserveButton.disabled = !Array.from(checkboxes).some(
                (checkbox) => checkbox.checked
            );
        });
    });
});
