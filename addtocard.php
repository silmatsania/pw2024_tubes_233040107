<?php
session_start();
include 'lib/connection.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah user_id ada di session
if (!isset($_SESSION['user_id'])) {
    die("User ID tidak ditemukan di session.");
}

// Ambil user_id dari session
$user_id = intval($_SESSION['user_id']);

// Fetch/ambil data dari tabel keranjang
$keranjangQuery = "SELECT `id_product`, `id_user`, `qty`, `created_at` FROM `keranjang`";
$keranjangResult = mysqli_query($conn, $keranjangQuery);

// Fetch/ambil data dari tabel products
$productsQuery = "SELECT `produk_id`, `kategori_id`, `nama_produk`, `harga_produk`, `image`, `deskripsi_produk` FROM `products`";
$productsResult = mysqli_query($conn, $productsQuery);

// Fetch/ambil data dari tabel user
$userQuery = "SELECT `id`, `email`, `nama`, `password` FROM `user`";
$userResult = mysqli_query($conn, $userQuery);

// Cek apakah parameter id disetel
if (isset($_GET['id']) && isset($_GET['act'])) {
    if ($_GET['act'] == 'hapus') {
        $itemId = intval($_GET['id']); // Konversi id menjadi integer

        // delete item dari tabel keranjang menggunakan prepared statement
        $deleteQuery = "DELETE FROM keranjang WHERE id_product = ? AND id_user = ?";
        $stmt = $conn->prepare($deleteQuery);
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }

        // Bind parameter id_product dan id_user
        $stmt->bind_param("ii", $itemId, $user_id);

        // Eksekusi pernyataan
        if ($stmt->execute() === TRUE) {
            // Redirect ke halaman addtocard.php setelah penghapusan berhasil
            header("Location: addtocard.php");
            exit; // Pastikan script berhenti setelah redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup pernyataan
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/stylee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'template/menu.php'; ?>
    <!-- Navbar end -->

    <!-- Shopping Cart -->
    <div class="container" style="margin-bottom: 200px; margin-top:50px">
        <h3 class="fw-light text-start">Shopping Cart</h3>
        <table class="table table-striped table-hover table-bordered product-table">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Remove</th>
                    <th scope="col">Product</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php
                if ($keranjangResult->num_rows > 0) {
                    while ($row = $keranjangResult->fetch_assoc()) {
                        // Fetch/ambil detail produk yang sesuai
                        // dengan asumsi `id_product` di tabel `keranjang` sama dengan `produk_id` di tabel `products`
                        $productId = $row['id_product'];
                        $productQuery = "SELECT `nama_produk`, `harga_produk`, `image` FROM `products` WHERE `produk_id` = ?";
                        $productStmt = $conn->prepare($productQuery);
                        $productStmt->bind_param("i", $productId);
                        $productStmt->execute();
                        $productResult = $productStmt->get_result();
                        $productData = $productResult->fetch_assoc();

                        echo "<tr>";
                        echo "<td><a href='?id=" . $row['id_product'] . "&act=hapus'><i class='bi bi-trash'></i></a></td>";
                        echo "<td>" . $productData['nama_produk'] . "</td>";
                        echo "<td><img style='width:100px' src='" . $productData['image'] . "' alt='Product Image'></td>";
                        echo "<td>" . number_format($productData['harga_produk'], 3) . "</td>";
                        echo "<td>" . $row['qty'] . "</td>";
                        echo "<td>" . number_format($productData['harga_produk'] * $row['qty'], 3) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No items in the cart.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="row cart-total">
            <div class="col">
                <table class="table">
                    <tbody>
                        <?php
                        // Kalkulator total harga
                        $totalPriceQuery = "SELECT SUM(`harga_produk` * `qty`) AS total_price FROM `products` INNER JOIN `keranjang` ON products.produk_id = keranjang.id_product WHERE keranjang.id_user = ?";
                        $totalPriceStmt = $conn->prepare($totalPriceQuery);
                        $totalPriceStmt->bind_param("i", $user_id);
                        $totalPriceStmt->execute();
                        $totalPriceResult = $totalPriceStmt->get_result();
                        $totalPriceData = $totalPriceResult->fetch_assoc();
                        $totalPrice = $totalPriceData['total_price'];

                        if($totalPrice >= 1){
                            echo "<tr>";
                            echo "<td class='fw-bold'>Total Price</td>";
                            echo "<td>Rp " . number_format($totalPrice, 3) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        <!-- Akhir kalkulator total harga -->
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-dark">Checkout</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Akhir shopping Cart -->

    <!-- footer -->
    <?php include 'template/footer.php'; ?>
    <!-- footer end -->

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>