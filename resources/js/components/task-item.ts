/**
 * Komponen TypeScript sederhana untuk menangani interaksi dengan item tugas.
 * Misalnya, mengubah status tugas saat diklik.
 */
export class TaskItem {
    private element: HTMLElement;
    private taskId: string | null;

    constructor(element: HTMLElement) {
        this.element = element;
        // Ambil ID tugas dari atribut data (data-task-id)
        this.taskId = this.element.dataset.taskId || null;
        this.init();
    }

    private init(): void {
        if (this.taskId) {
            console.log(`TaskItem initialized for task ID: ${this.taskId}`);
            // Tambahkan event listener untuk klik pada elemen tugas
            this.element.addEventListener('click', this.handleClick.bind(this));
        } else {
            console.warn('Elemen tugas tidak memiliki data-task-id.');
        }
    }

    private handleClick(): void {
        if (this.taskId) {
            alert(`Tugas "${this.element.querySelector('h3')?.textContent}" (ID: ${this.taskId}) diklik!`);

            // Contoh fungsionalitas: Toggle kelas 'completed'
            this.element.classList.toggle('bg-green-100');
            this.element.classList.toggle('bg-white'); // Kembali ke putih jika tidak selesai
            this.element.classList.toggle('border-green-400'); // Border hijau jika selesai

            // Di sini Anda bisa menambahkan logika AJAX untuk memperbarui status di backend
            // Misalnya:
            // fetch(`/tasks/${this.taskId}/toggle-status`, { method: 'POST' })
            //     .then(response => response.json())
            //     .then(data => console.log('Status updated:', data))
            //     .catch(error => console.error('Error updating status:', error));
        }
    }
}
