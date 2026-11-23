
document.addEventListener("DOMContentLoaded", function () {

    const elements = document.querySelectorAll(
        "button, nav a, input[type='submit']"
    );

    elements.forEach(function (element) {

        element.classList.add("glass-interactive");

        function updateLight(event) {
            const rect = element.getBoundingClientRect();

            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;

            element.style.setProperty("--pointer-x", x + "%");
            element.style.setProperty("--pointer-y", y + "%");
        }

        function startPress(event) {
            if (element.disabled) return;

            updateLight(event);
            element.classList.add("is-pressing");
        }

        function endPress() {
            element.classList.remove("is-pressing");
        }

        element.addEventListener("pointermove", updateLight);
        element.addEventListener("pointerdown", startPress);
        element.addEventListener("pointerup", endPress);
        element.addEventListener("pointercancel", endPress);
        element.addEventListener("pointerleave", endPress);
        element.addEventListener("blur", endPress);

        element.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.key === " ") {
                element.classList.add("is-pressing");
            }
        });

        element.addEventListener("keyup", endPress);
    });

});
