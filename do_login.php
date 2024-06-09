<?php
include 'lib/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email =  $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password (asumsikan passwords menggunakan password_hash())
        if (password_verify($password, $user['password'])) {
            // Password benar, mulai sesi dan arahkan ke dasbor
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            // password salah
            header("Location: login.php?error=Invalid%20email%20or%20password");
            exit();
        }
    } else {
        // email salah
        header("Location: login.php?error=Invalid%20email%20or%20password");
        exit();
    }
} else {
    // method permintaan tidak valid
    header("Location: login.php");
    exit();
}
?>