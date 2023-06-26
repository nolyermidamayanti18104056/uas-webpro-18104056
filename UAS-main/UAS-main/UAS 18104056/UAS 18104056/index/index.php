<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <script src="jquery-3.7.0.min.js"></script>

    <title>UAS</title>
    <!-- Hasil Pencarian -->
    <?php
    // Memeriksa apakah ada data yang dikirimkan dari proses.php
    include 'koneksi.php';

    $row['kota'] = 'Anda Belum Mencari data';
    $row['suhu'] = '0';
    $row['tekanan'] = '0';
    $row['kelembaban'] = '0 result';
    $row['kondisi'] = '0 result';


    if (isset($_GET['result'])) {
        $result = $_GET['result'];

        if ($result === "not_found") {
            $row['kota'] = 'Data Tidak Ada Dalam Database';
            $row['suhu'] = '0';
            $row['tekanan'] = '0';
            $row['kelembaban'] = '0 result';
            $row['kondisi'] = '0 result';

        } else {
            // Mendekode string JSON menjadi array
            $data = json_decode(urldecode($result), true);

            // Menampilkan data
            foreach ($data as $row) {
            }
        }
    }
    ?>
    <script>
        //Code Jquerry
        $(document).ready(function () {
            function tampilkanWaktu() {
                var sekarang = new Date();
                var hari = sekarang.getDate();
                var bulanI = sekarang.getMonth();
                var tahun = sekarang.getFullYear();

                // Array untuk menyimpan nama bulan
                var namaBulan = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                // Mendapatkan nama bulan berdasarkan indeks bulan
                var bulan = namaBulan[bulanI];

                // Membuat format tanggal yang sesuai
                var tanggal = hari + " " + bulan + " " + tahun;

                // Menampilkan tanggal pada elemen dengan id "waktu"
                var svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/></svg>';

                $("#waktu").html(svg + " Waktu saat ini: " + tanggal);
            }

            tampilkanWaktu();

            function suhu() {
                // Get data
                var C = <?php echo $row["suhu"]; ?>;
                // Process
                if(C === 0){
                    var hsl = "0°C / 0°F";
                }else{
                    var F = (C * 9 / 5) + 32;
                    var hsl = C + "°C / " + F + "°F";
                    
                };
                // Output
                $("#suhuf").html(hsl);
            }

            suhu();
        });
        var gambar = document.getElementById("gambar");

        function tampilkanGambar() {
            if (!navigator.onLine) {
                gambar.src = "img/city.jpg";
            }
        }

        // Panggil fungsi saat halaman selesai dimuat
        window.onload = tampilkanGambar;

        // Pantau perubahan status koneksi
        window.addEventListener('online', tampilkanGambar);
        window.addEventListener('offline', tampilkanGambar);
    </script>

</head>

<body onload="tampilkanWaktu()">
    <div class="box">
        <img id="gambar" src="https://source.unsplash.com/1920x1080/?anime" alt="" class="bg-img">
        <div class="card" style="width: 18rem">
            <!-- Formulir -->
            <form method="post" action="proses.php">
                <input type="text" class="search" type="search" placeholder="Cari Kota" name="kota" id="kota">
                <input type="submit" class="buttonsearch" name="submit" value="Cari">
            </form>
            <div class="card-body align-img">
                <h2 class="tcenter p">
                    <?php echo $row["kota"]; ?>
                </h2>
                <div class="img-container">
                    <img class="img" src="img/<?php echo $row["kondisi"]; ?>.png" alt="">
                </div>
                <h1 class="tcenter p suhu" id="suhuf" style="font-size: 45px"></h1>
                <p class="p" id="waktu"></p>
                <p class="p"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-droplet" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10a5 5 0 0 0 10 0c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z">
                            <path fill-rule="evenodd"
                                d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z">
                    </svg>
                    <?php echo " Kelembapan : " . $row["kelembaban"]."%"; ?>
                </p>
                <p class="p"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-wind" viewBox="0 0 16 16">
                        <path
                            d="M12.5 2A2.5 2.5 0 0 0 10 4.5a.5.5 0 0 1-1 0A3.5 3.5 0 1 1 12.5 8H.5a.5.5 0 0 1 0-1h12a2.5 2.5 0 0 0 0-5zm-7 1a1 1 0 0 0-1 1 .5.5 0 0 1-1 0 2 2 0 1 1 2 2h-5a.5.5 0 0 1 0-1h5a1 1 0 0 0 0-2zM0 9.5A.5.5 0 0 1 .5 9h10.042a3 3 0 1 1-3 3 .5.5 0 0 1 1 0 2 2 0 1 0 2-2H.5a.5.5 0 0 1-.5-.5z">
                    </svg>
                    <?php echo " Tekanan Angin : " . $row["tekanan"]."KMPH"; ?>
                </p>
                <p class="p"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-cloud" viewBox="0 0 16 16">
                        <path
                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z">
                    </svg>
                    <?php echo " Kondisi Awan : " . $row["kondisi"]; ?>
                </p>
            </div>
        </div>
    </div>
</body>
    <script>
        //Menampilkan Gambar ketika mode offline
        var gambar = document.getElementById("gambar");

        function tampilkanGambar() {
            if (!navigator.onLine) {
                gambar.src = "img/city.jpg";
            }
        }

        // Panggil fungsi saat halaman selesai dimuat
        window.onload = tampilkanGambar;

        // Pantau perubahan status koneksi
        window.addEventListener('online', tampilkanGambar);
        window.addEventListener('offline', tampilkanGambar);
    </script>
</html>