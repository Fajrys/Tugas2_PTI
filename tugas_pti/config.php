<?php
session_start();


$conn = mysqli_connect("localhost", "root", "", "db_kampus");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'id';

$teks = [
    'id' => [
        'title' => 'Data Mahasiswa',
        'login' => 'Masuk',
        'logout' => 'Keluar',
        'add' => 'Tambah Data',
        'save' => 'Simpan',
        'nim' => 'NIM',
        'name' => 'Nama',
        'major' => 'Jurusan',
        'action' => 'Aksi',
        'edit' => 'Ubah',
        'delete' => 'Hapus',
        'empty_err' => 'Semua kolom harus diisi!'
    ],
    'en' => [
        'title' => 'Student Data',
        'login' => 'Login',
        'logout' => 'Logout',
        'add' => 'Add Data',
        'save' => 'Save',
        'nim' => 'Student ID',
        'name' => 'Name',
        'major' => 'Major',
        'action' => 'Action',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'empty_err' => 'All fields must be filled!'
    ]
];
?>