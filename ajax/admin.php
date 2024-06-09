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

<!-- table -->
<div class="container" style="margin-bottom: 400px; margin-top:50px">
    <button type="button" class="btn text-white bg-dark"
        style="margin-bottom: 20px; margin-top:10px; background-color: black;" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        Tambah Data
    </button>
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
            <!-- php urutin nomor -->
            <?php $i = 1;?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <th scope="row"><?=$i?></th>
                <td><img src="<?= $row['image'] ?>" style="width:100px"></td>
                <td><?= $row['nama_produk'] ?></td>
                <td><?= $row['kategori_id'] ?></td>
                <td><?= $row['harga_produk'] ?></td>
                <td><?= $row['deskripsi_produk'] ?></td>
                <td>
                    <div class='d-flex'>
                        <button type='button' class='btn text-white bg-dark' style='margin-right: 10px;'
                            data-bs-toggle='modal' data-bs-target='#EditModal<?= $row['produk_id'] ?>'>
                            Edit
                        </button>
                        <form method='post' class="delete-form">
                            <input type='hidden' name='produk_id' value='<?= $row['produk_id'] ?>'>
                            <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php $i++; ?>
            <?php endwhile; ?>
            <?php else: ?>
            <tr>
                <td colspan="7">
                    <h3>Products not found.</h3>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$stmt->close();
$conn->close();
?>