const root = document.documentElement;

let savedTheme = null;

try {
    savedTheme = localStorage.getItem('theme');
} catch (e) {
    savedTheme = null;
}

if (savedTheme) {
    root.setAttribute('data-theme', savedTheme);
}

document.querySelectorAll('[data-theme-select]').forEach((select) => {
    select.value = root.getAttribute('data-theme') || 'light';

    select.addEventListener('change', (event) => {
        root.setAttribute('data-theme', event.target.value);

        try {
            localStorage.setItem('theme', event.target.value);
        } catch (e) {
        }

        document.querySelectorAll('[data-theme-select]').forEach((other) => {
            other.value = event.target.value;
        });
    });
});
