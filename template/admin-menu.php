<nav class="navbar navbar-expand-lg sticky-top" style="background-color: black;">
    <div class=" container">
        <a class="navbar-brand" href="#">
            <img src="image/gogolf.png" alt="GO GOLF Logo" style="height: 55px;">
        </a>
        <!-- <a class="navbar-brand text-white" href="#">GO GOLF</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex ms-auto">
            <ul class="navbar-nav justify-content-center" style="padding-right:250px">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="dashboard.php">DASHBOARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="tambahkategori.php">CATEGORY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="tambahproduk.php">PRODUCT</a>
                </li>

            </ul>
            <form action="" method="post" class="d-flex ms-auto" role="search">
                <input class="form-control me-2" style="width: 150px; height: 32px; border-radius: 15px;" type=" search"
                    placeholder="Search" aria-label="Search" id="keyword">
                <a href="index.php"><i class="bi bi-house-door"
                        style="font-size: 1.5rem; color: white; margin-left: 10px;"></i></a>
                <a href="logout.php"><i class="bi bi-box-arrow-in-left"
                        style="font-size: 1.5rem; color: white; margin-left: 20px;"></i></a>
        </div>
    </div>
</nav>