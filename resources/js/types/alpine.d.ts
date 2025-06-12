// resources/js/types/alpine.d.ts

// Ini memberitahu TypeScript bahwa objek 'Window' akan memiliki properti 'Alpine'
// yang bertipe 'any' (atau Anda bisa mendefinisikan tipenya lebih spesifik jika diperlukan).
declare global {
    interface Window {
        Alpine: any;
    }
}

export {}; // Pastikan ini adalah modul TypeScript
