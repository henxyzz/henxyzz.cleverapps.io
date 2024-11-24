const mysql = require('mysql');

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
    console.log('Terhubung ke MySQL database!');
});

module.exports = connection;