<?php

// Mengasumsikan Anda memiliki fungsi untuk mendapatkan koneksi database
$conn = new mysqli('localhost', 'root', '', 'pw2024_tubes_233040107');

$keyword = $_GET["keyword"];

// Gunakan prepared statements untuk menghindari SQL injection
$stmt = $conn->prepare("SELECT * FROM products WHERE produk_id LIKE ? OR kategori_id LIKE ? OR nama_produk LIKE ? OR harga_produk LIKE ? OR deskripsi_produk LIKE ?");
$likeKeyword = '%' . $keyword . '%';
$stmt->bind_param("sssss", $likeKeyword, $likeKeyword, $likeKeyword, $likeKeyword, $likeKeyword);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
.card-img-top {
    /* Memastikan gambar sesuai dengan kartu ukuran kartu */
    object-fit: cover;
}
</style>

<div class="container mt-5">
    <div class="row pt-4 pb-5">
        <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-12 col-md-4 pb-5">
            <div class="card">
                <img src="<?= $row['image'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-title"><small><?= $row['nama_produk'] ?></small></p>
                    <h5 class="card-text pb-4">IDR <?= $row['harga_produk'] ?></h5>
                    <div class="row">
                        <div class="">
                            <a href="halcard.php?id=<?= $row['produk_id'] ?>"
                                class="btn btn-custom bg-black text-white d-flex align-items-center justify-content-center"
                                style="width: 170px; height: 30px;">
                                <i class="bi bi-bag-dash" style="font-size: 0.85rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <h3>Product not found.</h3>
        <?php endif; ?>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
?>