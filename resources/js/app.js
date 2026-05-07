import './bootstrap';

window.toggleDropdown = function(element) {
    const dropdown = element.nextElementSibling;
    const isShowing = dropdown.classList.contains('show');
    
    // Close all other dropdowns if any (optional, but good for UX)
    document.querySelectorAll('.nav-dropdown').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.dropdown-toggle').forEach(el => el.classList.remove('active'));
    
    if (!isShowing) {
        dropdown.classList.add('show');
        element.classList.add('active');
    }
};
