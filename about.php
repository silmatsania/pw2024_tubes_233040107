<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- link css -->
    <link rel="stylesheet" href="css/stylee.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- link google font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>


    <!-- navbar -->

    <?php
    include 'template/menu.php'
    ?>

    <!-- navbar end==== -->

    <!-- about -->
    <div class="container mt-5 mb-5" style="margin-left: 200px; margin-right:200px ">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="about-us-card">
                    <h4>ABOUT US</h4>
                    <hr>
                    <p class="lead mt-4 " style="font-size: 1.15rem; line-height: 1.6; font-weight: 200;">
                        Welcome to
                        <b>GO GOLF</b>, your ultimate destination for all things golf.
                        We are dedicated to providing golf enthusiasts with top-quality equipment, apparel,
                        and accessories. Our mission is to enhance your golfing experience with the best products
                        available on the market.
                    </p>
                    <p class="lead" style="font-size: 1.15rem; line-height: 1.6; font-weight: 200;">At <b>GO GOLF </b>,
                        we
                        understand the passion and precision that the game of golf demands.
                        That's why we offer a carefully curated selection of gear from the most trusted brands. Whether
                        you're a seasoned pro or just starting out, we have everything you need to elevate your game.
                        Our knowledgeable staff is here to assist you with personalized recommendations and exceptional
                        service.</p>
                    <p class="lead mb-0" style="font-size: 1.15rem; line-height: 1.6; font-weight: 200;">Explore our
                        extensive range of golf clubs, balls, bags, apparel, and more.
                        Experience the difference that top-notch equipment can make in your performance. Visit us today
                        and discover why Golf Shop is the preferred choice for golfers everywhere.</p>

                </div>
                <div class="container mt-5 mb-5" style="font-size: 1.15rem; line-height: 1.6; font-weight: 200;">
                    <p><b>GO GOLF</b> is a store distributed by :</p>
                    <ol class="number-list ">
                        <li>ADIDAS</li>
                        <li>CALLAWAY</li>
                        <li>PRO ACTIVE</li>
                        <li>GRAND GOLF</li>
                        <li>BRIDGESTONE</li>
                        <li>SKY DREAM JUMP</li>
                        <li>TITLEIST</li>
                        <li>FOOTJOY</li>
                        <li>COOL</li>
                        <li> IOMIC</li>
                        <li> PING</li>
                        <li> TOURSTAGE</li>
                        <li> GOLF PRIDE</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- about end -->


    <!-- footer -->
    <?php
    include 'template/footer.php'
    ?>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>