<!-- navbar============ -->
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
                    <a class="nav-link active text-white" aria-current="page" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="product.php">PRODUCT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        CATEGORY
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="woman.php">WOMAN</a></li>
                        <li><a class="dropdown-item" href="men.php">MEN</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="equipment.php">EQUIPMENT</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="about.php">ABOUT</a>
                </li>
            </ul>
            <form action="" method="post" class="d-flex ms-auto" role="search">
                <input class="form-control me-2" style="width: 150px; height: 32px; border-radius: 15px;" type=" search"
                    placeholder="Search" aria-label="Search" id="keyword">
                <a href=""><i class="bi bi-search" style="font-size: 1.3rem; color: white; margin-left: 10px;"></i></a>
                <a href=""><i class="bi bi-person" style="font-size: 1.6rem; color: white; margin-left: 12px;"></i></a>
                <a href="addtocard.php">
                    <i class="bi bi-bag-dash" style="font-size: 1.4rem; color: white; margin-left: 15px;"></i>
                </a>

            </form>
        </div>
    </div>
</nav>
<!-- navbar end============ -->