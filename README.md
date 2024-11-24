# MyApp - Aplikasi Node.js dengan MySQL dan Fungsionalitas Email

MyApp adalah aplikasi sederhana berbasis Node.js yang terhubung ke database MySQL dan menyediakan fungsionalitas pengiriman email menggunakan Nodemailer. Aplikasi ini juga memiliki fitur upload dan penghapusan file serta folder, dengan sistem routing dinamis untuk file HTML dan PHP.

## Fitur
- **Autentikasi Pengguna:** Pengguna dapat login menggunakan username dan password.
- **Upload File:** Pengguna dapat meng-upload file ke server.
- **Hapus File dan Folder:** Pengguna dapat menghapus file dan folder dari server.
- **Route Dinamis:** Aplikasi menambahkan route secara otomatis berdasarkan file `.html` atau `.php` di folder `public`.
- **Koneksi ke Database MySQL:** Aplikasi menggunakan MySQL untuk menyimpan data pengguna.
- **Notifikasi Email:** Aplikasi dapat mengirim email menggunakan Nodemailer.

## Prasyarat
Sebelum menjalankan aplikasi ini, pastikan kamu sudah menginstal:
- [Node.js](https://nodejs.org/)
- [MySQL](https://www.mysql.com/)
