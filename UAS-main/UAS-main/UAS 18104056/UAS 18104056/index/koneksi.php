<?php
  // Menampilkan data cuaca dari database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cuaca";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
  }
?>