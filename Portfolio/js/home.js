/* -------------------------------
   Typing Animation (D)
--------------------------------*/
const text = "Hi, I'm Jane Sophie Beron";
let i = 0;

function type() {
    if (i < text.length) {
        document.getElementById("typing-text").textContent += text.charAt(i);
        i++;
        setTimeout(type, 80);
    }
}
type();

/* -------------------------------
   Reveal on Scroll (A)
--------------------------------*/
const reveals = document.querySelectorAll(".reveal");

const revealOptions = {
    threshold: 0.15
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("in-view");
            observer.unobserve(entry.target);
        }
    });
}, revealOptions);

reveals.forEach(r => observer.observe(r));

/* -------------------------------
   Back-to-top Button
--------------------------------*/
const topBtn = document.getElementById("backToTop");

window.addEventListener("scroll", () => {
    if (window.scrollY > 250) {
        topBtn.classList.add("visible");
    } else {
        topBtn.classList.remove("visible");
    }
});

topBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

const cards = document.querySelectorAll(".parallax-card");

cards.forEach(card => {
    card.addEventListener("mousemove", (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        card.style.transform = `rotateX(${-y / 20}deg) rotateY(${x / 20}deg) scale(1.02)`;
    });

    card.addEventListener("mouseleave", () => {
        card.style.transform = "rotateX(0deg) rotateY(0deg) scale(1)";
    });
});

document.body.classList.add("fade-in");

const cursorDot = document.createElement("div");
cursorDot.classList.add("cursor-dot");
document.body.appendChild(cursorDot);

const follower = document.createElement("div");
follower.classList.add("cursor-follower");
document.body.appendChild(follower);

document.addEventListener("mousemove", (e) => {
    cursorDot.style.left = `${e.clientX}px`;
    cursorDot.style.top = `${e.clientY}px`;

    follower.style.left = `${e.clientX}px`;
    follower.style.top = `${e.clientY}px`;

    const glow = document.createElement("div");
    glow.classList.add("cursor-glow");
    glow.style.left = `${e.clientX}px`;
    glow.style.top = `${e.clientY}px`;
    document.body.appendChild(glow);

    setTimeout(() => glow.remove(), 300);

    const trail = document.createElement("div");
    trail.classList.add("cursor-trail");
    trail.style.left = `${e.clientX}px`;
    trail.style.top = `${e.clientY}px`;
    document.body.appendChild(trail);

    setTimeout(() => trail.remove(), 600);
});
