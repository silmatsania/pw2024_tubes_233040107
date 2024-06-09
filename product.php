<?php 
include 'lib/connection.php';

// Query untuk mendapatkan kategori
$query = 'SELECT * FROM kategori';
$result_kategori = mysqli_query($conn, $query);

// Query untuk mendapatkan produk rekomendasi
$query_rekomendasi = 'SELECT k.id, k.nama_kategori, k.gambar, p.produk_id, p.nama_produk, p.harga_produk, p.image, p.deskripsi_produk 
                      FROM kategori k 
                      INNER JOIN products p ON k.id = p.kategori_id 
                      WHERE k.nama_kategori = "Woman" 
                      ORDER BY p.harga_produk DESC
                      LIMIT 5';
$result_produk_rekomendasi = mysqli_query($conn, $query_rekomendasi);

// Query untuk mendapatkan produk pria
$query_men = 'SELECT p.produk_id, k.nama_kategori, k.gambar, p.nama_produk, p.harga_produk, p.image, p.deskripsi_produk 
              FROM kategori k 
              INNER JOIN products p ON k.id = p.kategori_id 
              WHERE k.nama_kategori = "Men" 
              ORDER BY p.harga_produk DESC
              LIMIT 5';
$result_produk_men = mysqli_query($conn, $query_men);

// Query untuk mendapatkan produk highlight
$query_highlight = 'SELECT p.produk_id, k.nama_kategori, k.gambar, p.nama_produk, p.harga_produk, p.image, p.deskripsi_produk 
                    FROM kategori k 
                    INNER JOIN products p ON k.id = p.kategori_id 
                    ORDER BY RAND() 
                    LIMIT 5';
$result_produk_highlight = mysqli_query($conn, $query_highlight);

// Query untuk mendapatkan produk equipment
$query_equipment = 'SELECT p.produk_id, k.nama_kategori, k.gambar, p.nama_produk, p.harga_produk, p.image, p.deskripsi_produk 
                    FROM kategori k 
                    INNER JOIN products p ON k.id = p.kategori_id 
                    WHERE k.nama_kategori = "Equipment" 
                     ORDER BY p.harga_produk DESC
                    LIMIT 5';
$result_produk_equipment = mysqli_query($conn, $query_equipment);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- link css -->
    <link rel="stylesheet" href="css/stylee.css">

    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- css -->
    <style>
    .card {
        border: 1px solid #ddd;
        transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: scale(1.05);
        border: 1px solid red;
    }

    .card.clicked {
        border-color: red !important;
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    }

    .card.clicked .card-title {
        text-decoration: underline;
    }

    .btn-custom {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
        transition: background-color red;
    }

    .btn-custom:hover {
        background-color: red;
        color: #fff;
    }
    </style>
    <!-- akhir css -->

    <!-- navbar============ -->
    <?php
    include 'template/menu.php'
    ?>
    <!-- navbar end============ -->

    <!-- card product rekomendasi-->
    <div class="container">
        <h4 class="pt-5" style="font-weight: 350; text-align: center;">WOMEN COLLECTION</h4>
        <hr>
        <div class="row pt-4 pb-5">
            <?php if ($result_kategori):?>
            <?php while ($row = mysqli_fetch_assoc($result_produk_rekomendasi)):?>

            <div class="col">
                <div class="card">
                    <img src="<?=$row['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title"><small><?=$row['nama_produk']?></small></p>
                        <h5 class="card-text pb-4"> IDR <?=$row['harga_produk']?></h5>
                        <div class="row">
                            <div class="">
                                <a href="halcard.php?id=<?=$row['produk_id']?>"
                                    class="btn bg-black text-white d-flex align-items-center justify-content-center"
                                    style="width: 170px; height: 30px;"><i class="bi bi-bag-dash"
                                        style="font-size: 0.85rem;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile?>
            <?php endif ?>

        </div>
    </div>

    <!-- akhir card product rekomendasi -->

    <!-- card product men -->
    <div id="container">
        <div class="container">
            <h4 style="font-weight: 350; text-align: center;">MEN COLLECTION</h4>
            <hr>
            <div class="row pt-4 pb-5">
                <?php if ($result_kategori):?>
                <?php while ($row = mysqli_fetch_assoc($result_produk_men)):?>
                <div class="col">
                    <div class="card">
                        <img src="<?=$row['image']?>" class="card-img-top" alt="...">
                        <div class="card-body" style="width: 12rem;">
                            <p class="card-title"><small><?=$row['nama_produk']?></small></p>
                            <h5 class="card-text pb-4"> IDR <?=$row['harga_produk']?></h5>
                            <div class="row">
                                <div class="">
                                    <a href="halcard.php?id=<?=$row['produk_id']?>"
                                        class="btn bg-black text-white d-flex align-items-center justify-content-center"
                                        style="width: 170px; height: 30px;"><i class="bi bi-bag-dash"
                                            style="font-size: 0.85rem;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile?>

                <?php endif ?>
            </div>
        </div>
    </div>
    <!-- akhir card product men-->

    <!-- card foto-->
    <div class="slide">
        <img src="image/golf7.jpg" class="card-img" alt="..." style=" height: 250px;">
    </div>
    <!-- card foto-->

    <!-- card product highligh-->
    <div id="container">
        <div class="container pt-5 pb-5">
            <h4 style="font-weight: 350; text-align: center;">PRODUCT HIGHLIGHT</h4>
            <hr>
            <div class="row pt-4 pb-5">
                <?php if ($result_kategori):?>
                <?php while ($row = mysqli_fetch_assoc($result_produk_highlight)):?>
                <div class="col">
                    <div class="card">
                        <img src="<?=$row['image']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-title"><small><?=$row['nama_produk']?></small></p>
                            <h5 class="card-text pb-4"> IDR <?=$row['harga_produk']?></h5>
                            <div class="row">
                                <div class="">
                                    <a href="halcard.php?id=<?=$row['produk_id']?>"
                                        class="btn bg-black text-white d-flex align-items-center justify-content-center"
                                        style="width: 170px; height: 30px;"><i class="bi bi-bag-dash"
                                            style="font-size: 0.85rem;" style="font-size: 0.85rem;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile?>

                <?php endif ?>
            </div>
        </div>
    </div>

    <!-- akhir card produk highligh-->

    <!-- card foto-->
    <div class="slide">
        <img src="image/golf10.jpg" class="card-img" alt="..." style=" height: 250px;">
    </div>
    <!-- card foto-->

    <!-- card product equipment-->
    <div id="container">
        <div class="container pt-5 pb-5">
            <h4 style="font-weight: 350; text-align: center;"> GOLF ENQUIPMENT</h4>
            <hr>
            <div class="row pt-4 pb-5">
                <?php if ($result_kategori):?>
                <?php while ($row = mysqli_fetch_assoc($result_produk_equipment)):?>
                <div class="col">
                    <div class="card">
                        <img src="<?=$row['image']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-title"><small><?=$row['nama_produk']?></small></p>
                            <h5 class="card-text pb-4"> IDR <?=$row['harga_produk']?></h5>
                            <div class="row">
                                <div class="">
                                    <a href="halcard.php?id=<?=$row['produk_id']?>"
                                        class="btn bg-black text-white d-flex align-items-center justify-content-center"
                                        style="width: 170px; height: 30px;"><i class="bi bi-bag-dash"
                                            style="font-size: 0.85rem;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile?>

                <?php endif ?>
            </div>
        </div>
    </div>
    <!-- akhir card product equipment -->

    <!-- footer -->
    <?php
    include 'template/footer.php'
    ?>
    <!-- footer end -->

    <!-- java buat tombol click -->
    <!-- <script>
    let lastClickedCard = null;

    function toggleCard(card) {
        if (lastClickedCard && lastClickedCard !== card) {
            lastClickedCard.classList.remove('clicked');
        }
        card.classList.toggle('clicked');
        lastClickedCard = card.classList.contains('clicked') ? card : null;
    }
    </script> -->


    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- akhir boostrap -->

    <!-- ajax -->
    <script src="js/script.js"></script>
    <!-- akhir ajax -->


</body>

</html>