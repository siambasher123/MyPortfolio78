// Typing Animation 
const nameEl = document.getElementById('typed-name');
if(nameEl) {
    const text = "Srabon";
    nameEl.textContent = "";
    let index = 0;

    function typeName() {
        if(index < text.length) {
            nameEl.textContent += text.charAt(index);
            index++;
            setTimeout(typeName, 150);
        }
    }
    typeName();
}
//skillbar animation
const skillBars = document.querySelectorAll('.skill-bar');

function animateSkills() {
    skillBars.forEach(bar => {
        const rect = bar.getBoundingClientRect();
        if(rect.top < window.innerHeight) {
            bar.style.width = bar.getAttribute('data-width');
        }
    });
}

window.addEventListener('scroll', animateSkills);
window.addEventListener('load', animateSkills); // animate on page load too
