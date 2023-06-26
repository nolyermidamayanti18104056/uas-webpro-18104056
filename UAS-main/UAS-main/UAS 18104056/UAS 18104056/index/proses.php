<?php
// Menghubungkan ke database
include 'koneksi.php';

$kota =$_POST['kota'];

// Memeriksa apakah form telah dikirim
if (isset($_POST['submit'])) {
    $kota = $_POST['kota'];

    // Menghindari serangan SQL injection
    $kota = mysqli_real_escape_string($conn, $kota);

    // Mengeksekusi query
    $sql = "SELECT * FROM lokasi WHERE kota = '$kota'";
    $result = $conn->query($sql);

    // Memeriksa apakah query menghasilkan data
    if ($result->num_rows > 0) {
        // Mengambil data sebagai array
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Mengirimkan data ke index.php
        header("Location: Index.php?result=" . urlencode(json_encode($data)));
        exit();
    } else {
        // Mengirimkan pesan "not_found" ke index.php
        header("Location: Index.php?result=not_found");
        exit();
    }
}

// Menutup koneksi ke database
$conn->close();
?>