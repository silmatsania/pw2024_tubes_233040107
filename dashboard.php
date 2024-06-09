<?php
include 'lib/checklogin.php';

?>

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
</head>

<body>


    <!-- navbar -->
    <?php
    include 'template/admin-menu.php'
    ?>
    <!-- akhir navbar-->

    <!-- dashboard -->
    <div class="section" style="margin-bottom: 400px; margin-top:100px">
        <div class="container text-center">
            <div class="box-dasboard mx-auto mt-4">
                <h3 class="mb-0">Hello <?=$_SESSION['nama']?></h3>
                <p class="mt-3">This is your dashboard.</p>
            </div>
        </div>
    </div>
    <!-- akhir dashboard -->

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