/* ---------------------------------
   Fade-in on load
----------------------------------*/
document.body.classList.add("fade-in");

/* ---------------------------------
   Reveal on Scroll
----------------------------------*/
const reveals = document.querySelectorAll(".reveal");

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("in-view");
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });

reveals.forEach(r => observer.observe(r));

const follower = document.createElement("div");
follower.classList.add("cursor-follower");
document.body.appendChild(follower);

document.addEventListener("mousemove", (e) => {
    follower.style.left = `${e.clientX}px`;
    follower.style.top = `${e.clientY}px`;

    const glow = document.createElement("div");
    glow.classList.add("cursor-glow");
    glow.style.left = `${e.clientX}px`;
    glow.style.top = `${e.clientY}px`;
    document.body.appendChild(glow);

    setTimeout(() => glow.remove(), 300);
});
