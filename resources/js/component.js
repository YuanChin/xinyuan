document.addEventListener('alpine:init', () => {
    Alpine.data("dropdown", () => ({
        isOpen: false,
        change() {
            this.isOpen = !this.isOpen;
        },
        close() {
            this.isOpen = false;
        }
    }));
});