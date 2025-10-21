

LaporLingkungan 🏡

LaporLingkungan adalah aplikasi web berbasis Laravel yang memungkinkan warga untuk melaporkan masalah lingkungan di sekitar mereka. Proyek ini bertujuan untuk meningkatkan kesadaran dan mempercepat penanganan isu-isu lokal seperti tumpukan sampah liar, fasilitas umum yang rusak, atau jalan berlubang.

Proyek ini terinspirasi oleh *Tujuan Pembangunan Berkelanjutan (SDG) \#11: Kota dan Permukiman Berkelanjutan*.



## ✨ Fitur Utama

  * ✅ *Autentikasi Pengguna:* Sistem pendaftaran (register) dan masuk (login) yang aman menggunakan Laravel Breeze.
  * 📝 *Manajemen Laporan (CRUD):* Pengguna dapat membuat, melihat, mengubah, dan menghapus laporan masalah lingkungan.
  * 🖼️ *Upload Foto:* Setiap laporan dapat disertai dengan bukti foto untuk memberikan detail yang lebih jelas.
  * 🔐 *Otorisasi:* Pengguna hanya dapat mengubah atau menghapus laporan yang mereka buat sendiri.
  * 🎨 *Tampilan Responsif:* Dibangun dengan Tailwind CSS agar dapat diakses dengan baik di desktop maupun perangkat mobile.



 🛠️ Teknologi yang Digunakan

  * **Backend:** PHP 8.2, Laravel 10
  * **Frontend:** Blade, Tailwind CSS, Alpine.js
  * **Database:** MySQL
  * **Web Server:** Nginx / Apache (via Laragon)
  * **Development Environment:** Laragon




🏗️ Struktur Database

Proyek ini menggunakan dua tabel utama:

1.  *`users`*: Menyimpan data pengguna (disediakan oleh Laravel Breeze).

      * `id`, `name`, `email`, `password`, `timestamps`

2.  *`laporans`*: Menyimpan semua data laporan yang dibuat.

      * `id` (PK)
      * `user_id` (FK ke `users.id`)
      * `judul`
      * `deskripsi`
      * `lokasi`
      * `foto`
      * `status` (enum: 'Dilaporkan', 'Diproses', 'Selesai Ditangani')
      * `timestamps`

Relasi antara keduanya adalah **One-to-Many**: Satu `User` bisa memiliki banyak `Laporan`.



## 🤝 Panduan Berkontribusi

Kami sangat terbuka untuk kontribusi\! Silakan ikuti alur kerja berikut:

1.  *Fork* repository ini.
2.  Buat **branch** baru untuk fitur Anda (`git checkout -b fitur/NamaFiturBaru`).
3.  *Commit** perubahan yang Anda buat (`git commit -m 'feat: Menambahkan NamaFiturBaru'`).
4.  *Push* ke branch Anda (`git push origin fitur/NamaFiturBaru`).
5.  Buat *Pull Request* baru.

-----

## 📄 Lisensi

Proyek ini berada di bawah Lisensi MIT. Lihat file `LICENSE` untuk detail lebih lanjut.
