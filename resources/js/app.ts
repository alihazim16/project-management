import Alpine from 'alpinejs';
import { TaskItem } from './components/task-item'; // Import komponen TaskItem

window.Alpine = Alpine;

Alpine.start();

// Contoh fungsi TypeScript (opsional, bisa dihapus)
function greet(name: string): void {
    console.log(`Halo, ${name}! Selamat datang di aplikasi manajemen proyek Anda.`);
}

greet('Tim');

// Inisialisasi komponen TaskItem untuk setiap elemen dengan class 'task-item-container'
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.task-item-container').forEach(element => {
        new TaskItem(element as HTMLElement); // Menginisialisasi TaskItem untuk setiap elemen
    });
});
