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
            ORDER BY p.harga_produk ASC
            LIMIT 5';
$result_produk_rekomendasi = mysqli_query($conn, $query_rekomendasi);

// Query untuk mendapatkan produk pria
$query_men = 'SELECT p.produk_id, k.nama_kategori, k.gambar, p.nama_produk, p.harga_produk, p.image, p.deskripsi_produk 
              FROM kategori k 
              INNER JOIN products p ON k.id = p.kategori_id 
              WHERE k.nama_kategori = "Men" 
              ORDER BY p.harga_produk ASC 
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
                    ORDER BY p.harga_produk ASC 
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

    .btn-custom {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
        transition: background-color 0.3s;
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

    <!-- slide 1-->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/wallpapergolf3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/wall7.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/wall8.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- akhir slide 1-->
    <style>
    .container-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    </style>
    <!-- card kategori-->
    <div class="container-fluid text-center pt-4">
        <div class="row  pt-4 pb-5" style="margin:5px;">
            <h4 style="font-weight: 350; text-align: left; ">DEFINE YOUR GOAL</h4>
            <?php if ($result_kategori):?>
            <?php while ($row = mysqli_fetch_assoc($result_kategori)):?>
            <div class="col-6 col-md-3 pt-2 pb-2">
                <div class="card" data-bs-theme="" style="width: 19.5rem;">
                    <img src="<?=$row['gambar']?>" class="card-img-top" alt="..">
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-secondary btn-sm"><a href="#" class="btn">
                                <h7 class="card-title"><?=$row['nama_kategori']?></h7>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <?php endwhile?>
            <?php endif ?>

        </div>
    </div>
    <!-- akhir card kategori-->


    <!-- card product rekomendasi-->
    <div id="container">
        <div class="container-fluid" style="padding-top: 40px; padding-bottom:10px;">
            <h4 style="font-weight: 350; ">WOMEN COLLECTION</h4>
            <div class="row pt-4 pb-5">
                <?php if ($result_kategori):?>
                <?php while ($row = mysqli_fetch_assoc($result_produk_rekomendasi)):?>

                <div class="col pb-5">
                    <div class="card">
                        <img src="<?=$row['image']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-title"><small><?=$row['nama_produk']?></small></p>
                            <h5 class="card-text pb-4"> IDR <?=$row['harga_produk']?></h5>
                            <div class="row">
                                <div class="">
                                    <a href="halcard.php?id=<?=$row['produk_id']?>"
                                        class="btn bg-black text-white d-flex align-items-center justify-content-center"
                                        style="width: 210px; height: 30px;"><i class="bi bi-bag-dash"
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
    <!-- akhir card product rekomendasi -->

    <!-- card foto-->
    <div class="slide">
        <img src="image/golf7.jpg" class="card-img" alt="..." style=" height: 250px;">
    </div>
    <!-- card foto-->

    <!-- card product men-->
    <div id="container">
        <div class="container-fluid" style="padding-top: 100px; padding-bottom:50px">
            <h4 style="font-weight: 350; ">MEN COLLECTION</h4>
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
                                        style="width: 210px; height: 30px;"><i class="bi bi-bag-dash"
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
    <!-- akhir card produk men-->

    <!-- card foto-->
    <div class="slide">
        <img src="image/golf10.jpg" class="card-img" alt="..." style=" height: 250px;">
    </div>
    <!-- card foto-->

    <!-- card product equipment-->
    <div id="container">
        <div class="container-fluid" style="padding-top: 100px;">
            <h4 style="font-weight: 350; ">LATEST GOLF CLUB</h4>
            <div class="row pt-4 pb-5">
                <?php if ($result_kategori):?>
                <?php while ($row = mysqli_fetch_assoc($result_produk_equipment)):?>
                <div class="col  pb-5">
                    <div class="card" onclick="toggleCard(this)">
                        <img src="<?=$row['image']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-title"><small><?=$row['nama_produk']?></small></p>
                            <h5 class="card-text pb-4"> IDR <?=$row['harga_produk']?></h5>
                            <div class="row">
                                <div class="">
                                    <a href="halcard.php?id=<?=$row['produk_id']?>"
                                        class="btn bg-black text-white d-flex align-items-center justify-content-center"
                                        style="width: 210px; height: 30px;"><i class="bi bi-bag-dash"
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


    <!-- about -->
    <div class="container mt-5">
        <div class="row  pb-4 justify-content-center text-center">
            <div class="col-12 col-md-8">
                <h4 style="font-weight: 375;">ABOUT GOLF SHOP</h4>
                <br>
                <p style="font-size: 1.15rem; line-height: 1.6; font-weight: 200;">Discover the best in golf gear at
                    our
                    online store. From premium clubs and balls to stylish apparel and accessories, we offer
                    everything
                    you need to elevate your game. Shop top brands, enjoy competitive prices, and benefit from fast,
                    reliable shipping. Whether you're a seasoned pro or just starting out, our expert selection and
                    exceptional customer service will help you swing with confidence. Plus, take advantage of our
                    exclusive
                    deals and promotions. Tee off with us today and experience the difference quality makes!</p>
                <br>
                <div class="container mt-3 mb-5 ">
                    <a href="about.php" class="btn bg-black text-white"
                        style="font-size: 1.10rem; padding: 0.75rem 1.5rem;">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir about -->

    <!-- footer -->
    <?php
    include 'template/footer.php'
    ?>
    <!-- footer end -->

    <!-- jaca buat tombol click -->
    <!-- <script>
    function toggleCard(card) {
        card.classList.toggle('clicked');
    }
    </script> -->
    <!-- akhir java buat tombol script -->

    <!-- java boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- ajax -->
    <script src="js/script.js"></script>



</body>

</html>