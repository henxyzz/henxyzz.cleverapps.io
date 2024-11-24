require('dotenv').config();
const express = require('express');
const nodemailer = require('nodemailer');
const mysql = require('mysql');
const bcrypt = require('bcrypt');
const path = require('path');
const fs = require('fs');
const app = express();

const PORT = process.env.PORT || 8080;
const COOLDOWN_DURATION = 20 * 1000; // Durasi cooldown dalam milidetik (20 detik)
let cooldowns = {}; // Objek untuk menyimpan cooldown per email

// Middleware untuk parsing JSON dan mengatur static files
app.use(express.json());
app.use(express.static('public')); // Folder untuk file HTML dan CSS

// Koneksi database MySQL
const connection = mysql.createConnection({
    host: process.env.MYSQL_ADDON_HOST,
    database: process.env.MYSQL_ADDON_DB,
    user: process.env.MYSQL_ADDON_USER,
    password: process.env.MYSQL_ADDON_PASSWORD
});

// Menghubungkan ke database
connection.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL:', err);
        return;
    }
    console.log('Connected to MySQL database!');
});

// Rute untuk mengakses halaman utama API
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.php')); // Mengirim home.html sebagai respons
});

// Fungsi untuk menambahkan route dinamis berdasarkan file
function addDynamicRoutes() {
    const folderPath = path.join(__dirname, 'public'); // Folder tempat file .html atau .php berada

    fs.readdirSync(folderPath).forEach((file) => {
        const fileExt = path.extname(file);
        if (fileExt === '.html' || fileExt === '.php') {
            const route = '/' + path.basename(file, fileExt); // Membuat route berdasarkan nama file
            const filePath = path.join(folderPath, file); // Path lengkap ke file

            // Menambahkan route baru
            app.get(route, (req, res) => {
                res.sendFile(filePath); // Kirimkan file ke pengguna
            });

            console.log(`Route added: ${route}`);
        }
    });
}

// Menambahkan route dinamis ketika server dimulai
addDynamicRoutes();

// Menangani rute untuk kesalahan 404
app.use((req, res) => {
    res.status(404).sendFile(path.join(__dirname, '404.html'));
});

// Menangani kesalahan server umum
app.use((err, req, res, next) => {
    console.error('Terjadi kesalahan pada server:', err);
    res.status(500).json({ message: 'Terjadi kesalahan pada server' });
});

// Menjalankan server Express
app.listen(PORT, () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
});