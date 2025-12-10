const stars = document.querySelectorAll("#starBox span");
const ratingValue = document.getElementById("ratingValue");

stars.forEach(star => {
    star.addEventListener("click", () => {
        let value = star.dataset.value;
        ratingValue.value = value;

        stars.forEach(s => s.classList.remove("active"));
        for (let i = 0; i < value; i++) {
            stars[i].classList.add("active");
        }
    });
});
