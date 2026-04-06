// LOADING HILANG
window.addEventListener("load", function () {
    const loader = document.getElementById("page-loader");
    if (loader) {
        setTimeout(() => loader.style.display = "none", 800);
    }
});

// COUNTER
document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {
        const target = +counter.dataset.target;
        let count = 0;
        const speed = target / 100;

        const update = () => {
            if (count < target) {
                count += speed;
                counter.innerText = Math.ceil(count);
                setTimeout(update, 20);
            } else {
                counter.innerText = target;
            }
        };
        update();
    });
});
