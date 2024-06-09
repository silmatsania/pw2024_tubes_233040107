<?php
session_start();
include 'lib/connection.php';
// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$query = "SELECT 
            p.produk_id, p.kategori_id, 
            k.nama_kategori, 
            p.nama_produk, 
            p.harga_produk, 
            p.image, 
            p.deskripsi_produk 
          FROM 
            products p
          JOIN 
            kategori k 
          ON 
            p.kategori_id = k.id
          WHERE 
            p.produk_id = $id";

$result = mysqli_query($conn,$query);
$produk = $result->fetch_assoc();


if(isset($_GET['id'])&& isset($_GET['qty'])) {
    // Ambil data dari form
    $product_id = $_GET['id'];
    $qty = $_GET['qty'];
    $user_id = $_SESSION['user_id'];

    // Periksa apakah barang sudah ada di keranjang
    $query_check = "SELECT * FROM keranjang WHERE id_product  = $product_id AND id_user  = $user_id";
    $result_check = mysqli_query($conn, $query_check);
    
    if(mysqli_num_rows($result_check) > 0) {
        // Jika barang sudah ada di keranjang, update jumlahnya
        $query_update = "UPDATE keranjang SET qty = qty + $qty WHERE id_product  = $product_id AND id_user  = $user_id";
        $result_update = mysqli_query($conn, $query_update);
        
        if($result_update) {
            header("Location: addtocard.php");
        } else {
            echo "Gagal menambahkan barang ke keranjang: " . mysqli_error($conn);
        }
    } else {
        // Jika barang belum ada di keranjang, tambahkan sebagai item baru
        $query_insert = "INSERT INTO keranjang (id_product , id_user , qty) VALUES ($product_id, $user_id, $qty)";
        $result_insert = mysqli_query($conn, $query_insert);
        
        if($result_insert) {
            header("Location: addtocard.php");
        } else {
            echo "Gagal menambahkan barang ke keranjang: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produk['nama_produk']; ?> - Detail Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">



    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- navbar -->
    <?php
    include 'template/menu.php'
    ?>
    <!--  akhir navbar -->
    <style>
    .container-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    </style>

    <!-- halaman card -->
    <div class="container-card">
        <div class="card mb-3" style="width: 100%; max-width: 1200px; height: auto;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $produk['image']; ?>" class="img-fluid rounded-start"
                        alt="<?php echo $produk['nama_produk']; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 style="font-weight: 400; text-align: left;"><?php echo $produk['nama_produk']; ?></h3>
                        <p class="text-muted"><?php echo $produk['nama_kategori']; ?></p>
                        <hr>
                        <p class="card-text"><small class="text-body-secondary">Description :</small></p>
                        <p class="card-text"><?php echo $produk['deskripsi_produk']; ?></p>
                        <hr>
                        <h3>IDR <?php echo number_format($produk['harga_produk'], 3,'.'); ?></h3>
                        <hr>
                        <p class="card-text"><small class="text-body-secondary">Quantity</small></p>
                        <div class="d-flex align-items-center">
                            <button id="decrease" class="btn btn-sm" style="background-color: black;"><i
                                    class="bi bi-dash text-white"></i></button>
                            <span id="quantity" class="mx-2">1</span>
                            <button id="increase" class="btn btn-sm btn-dark" style="background-color: black;"><i
                                    class="bi bi-plus-lg text-white"></i></button>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="?id=<?php echo $produk['produk_id']; ?>&qty=1" id="addToCart"
                                class="btn bg-black text-white align-text"
                                style="width: 250px; height: 40px; background-color: black;">ADD TO CART</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <button type="submit" class="btn bg-black text-white">Read More</button>
    </div>
    <!-- akhir halaman card-->

    <!-- footer -->
    <?php
    include 'template/footer.php'
    ?>
    <!-- footer end -->

    <!-- java script buat qty/quantity -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const quantitySpan = document.getElementById('quantity');
        const addToCartButton = document.getElementById('addToCart');

        let quantity = 1;

        decreaseButton.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantitySpan.textContent = quantity;
                updateAddToCartLink();
            }
        });

        increaseButton.addEventListener('click', () => {
            quantity++;
            quantitySpan.textContent = quantity;
            updateAddToCartLink();
        });

        function updateAddToCartLink() {
            addToCartButton.href = `?id=<?php echo $produk['produk_id']; ?>&qty=${quantity}`;
        }
    });
    </script>



</body>

</html>