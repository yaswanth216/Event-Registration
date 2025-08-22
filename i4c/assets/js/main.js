// Smooth scroll for nav links
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener("click", function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({ behavior: "smooth" });
        }
    });
});

// Cache navbar links and sections
const navLinks = document.querySelectorAll('.nav-links a');
const sections = Array.from(navLinks).map(link => {
  const id = link.getAttribute('href').substring(1);
  return document.getElementById(id);
});

// Function to get current section in viewport
function onScroll() {
  const scrollPos = window.scrollY + 120; // 120 to consider fixed navbar height
 
  let currentIndex = sections.findIndex(section => {
    if (!section) return false;
    // Section top and bottom relative to viewport
    const top = section.offsetTop;
    const bottom = top + section.offsetHeight;
    return scrollPos >= top && scrollPos < bottom;
  });

  // If no section matches (e.g., scrolled past last), deactivate all active
  if (currentIndex === -1) {
    navLinks.forEach(link => link.classList.remove('active'));
    return;
  }
  
  // Remove active from all links and add to current
  navLinks.forEach(link => link.classList.remove('active'));
  navLinks[currentIndex].classList.add('active');
}

// Attach scroll listener
window.addEventListener('scroll', onScroll);

// Optional: run at page load to highlight correct nav
document.addEventListener('DOMContentLoaded', onScroll);

function toggleMenu() {
  document.getElementById("navLinks").classList.toggle("show");
}



