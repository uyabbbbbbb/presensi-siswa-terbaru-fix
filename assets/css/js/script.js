
document.addEventListener("DOMContentLoaded", function () {

    // Menandai menu yang sedang dibuka
    const links = document.querySelectorAll("nav a");
    const halaman = window.location.pathname;

    links.forEach(function (link) {
        const tujuan = new URL(link.href).pathname;

        if (tujuan === halaman) {
            link.classList.add("active");
            link.setAttribute("aria-current", "page");

            link.scrollIntoView({
                behavior: "smooth",
                block: "nearest",
                inline: "nearest"
            });
        }
    });

    // Navbar bisa digeser dengan mouse
    const navbar = document.querySelector("nav");

    if (navbar) {
        navbar.addEventListener("wheel", function (event) {
            if (navbar.scrollWidth > navbar.clientWidth) {
                if (Math.abs(event.deltaY) > Math.abs(event.deltaX)) {
                    event.preventDefault();
                    navbar.scrollLeft += event.deltaY;
                }
            }
        }, { passive: false });
    }

    // Mencegah tombol submit diklik berulang
    document.querySelectorAll("form").forEach(function (form) {

        form.addEventListener("submit", function () {
            const tombol = form.querySelector(
                'button[type="submit"], button:not([type]), input[type="submit"]'
            );

            if (tombol) {
                tombol.disabled = true;
                tombol.style.opacity = "0.7";
            }
        });

    });

});
