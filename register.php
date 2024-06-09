<?php
include 'lib/connection.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User baru berhasil ditambahkan!');
        </script>";
        // Redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        echo mysqli_error($conn);
    }
}

//fungsi registrasi
function registrasi($data) {
    global $conn;

    // periksa apakah kunci yang diperlukan ada di array $data
    if(!isset($data["email"]) || !isset($data["nama"]) || !isset($data["password"])) {
        // tangani kasus di mana kunci yang diperlukan tidak ada
        echo "<script>
        alert('Email, nama, atau password tidak ditemukan!');
        </script>";
        return false;
    }


    // dapatkan data dari array $data
    $email = mysqli_real_escape_string($conn, $data["email"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // penggunaan fungsi tidak digunakan lagi
    $email = stripslashes($email);
    $nama = stripslashes($nama);

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // enkripsi/mengamankan password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // permintaan untuk memasukkan data pengguna ke dalam database
    $query = "INSERT INTO user (email, nama, password) VALUES ('$email', '$nama', '$password')";
    
    // jalankan kueri
    if(mysqli_query($conn, $query)) {
        return mysqli_affected_rows($conn);
    } else {
        // menangani kesalahan eksekusi kueri
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <style>
    .form-control {
        border: 1px solid #555;
    }

    .form-control:focus {
        border-color: #777;
    }
    </style>

</head>

<body>
    <!-- table registrasi -->
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <div class="form-container">
                    <h4 class="card-title text-center mb-4 fw-bold">R E G I S T R A T I O N</h4>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama:</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Konfirmasi Password:</label>
                            <input type="password" class="form-control" name="password2" id="password2" required>
                        </div>
                        <button type="submit" class="btn bg-black text-white w-100" name="register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>