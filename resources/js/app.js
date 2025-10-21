// resources/js/app.js

// 1. Impor Bootstrap.js (untuk keperluan default seperti setup Axios)
import './bootstrap';

// 2. Impor dan Inisialisasi Alpine.js (Wajib untuk komponen Blade)
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Tambahkan plugin yang sering digunakan jika diperlukan, misalnya untuk transisi
import focus from '@alpinejs/focus';
Alpine.plugin(focus);

// Mulai Alpine
Alpine.start();

// Anda bisa menambahkan kode JavaScript kustom di sini, misalnya untuk efek klik, modal, dll.
// Contoh:
// document.addEventListener('DOMContentLoaded', () => {
//     console.log('JavaScript berjalan!');
// });