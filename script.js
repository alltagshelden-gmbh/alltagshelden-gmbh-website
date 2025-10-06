// === INTERACTIVE ENHANCEMENTS ===
// Add click ripple effect to buttons
document.querySelectorAll('.cta-button').forEach(button => {
    button.addEventListener('click', function (e) {
        const ripple = document.createElement('div');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Accessibility
if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('.bg-element').forEach(el => {
        el.style.animation = 'none';
    });
}

// Page load optimization
window.addEventListener('load', () => {
    document.body.style.opacity = '1';
    document.body.style.transition = 'opacity 0.3s ease-in-out';
});

// === MODAL FUNCTIONS ===
function openModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'block';
    modal.offsetHeight;
    modal.classList.add('show');
    document.body.classList.add('modal-open');
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }, 300);
}

// ESC-Taste zum Schließen
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Download the modal image. Keeps modal open and does not propagate click events.
function downloadModalImage() {
    const img = document.querySelector('#imageModal .modal-content');
    if (!img) return;

    // Determine image source
    const src = img.getAttribute('src') || img.src;
    if (!src) return;

    // Create an anchor to download the image. Handle blob/data URLs and normal URLs.
    const a = document.createElement('a');
    a.style.display = 'none';
    a.href = src;

    // Try to derive a filename from the src
    try {
        const url = new URL(src, window.location.href);
        const pathname = url.pathname;
        const name = pathname.substring(pathname.lastIndexOf('/') + 1) || 'image';
        a.download = name;
    } catch (err) {
        a.download = 'image';
    }

    document.body.appendChild(a);
    a.click();
    a.remove();
}
