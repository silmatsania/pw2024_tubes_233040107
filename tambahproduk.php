<?php
include 'lib/connection.php';
include 'lib/checklogin.php';

// Query untuk mengambil produk dan kategori terkait
$query = 'SELECT p.produk_id, p.kategori_id, p.nama_produk, p.harga_produk, p.image, p.deskripsi_produk, k.nama_kategori 
          FROM products p 
          JOIN kategori k ON p.kategori_id = k.id';
$result_products = mysqli_query($conn, $query);

// Query untuk mengambil semua kategori
$query_kategori = 'SELECT id, nama_kategori FROM kategori';
$result_kategori = mysqli_query($conn, $query_kategori);

#tambah data================================================================
if (isset($_POST['tambah'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kategori_id = $_POST['kategori_id'];
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $deskripsi_produk = $_POST['deskripsi_produk'];

        // Handle file upload
        $target_dir = "uploads/";
        $original_file_name = basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
        $unique_file_name = uniqid() . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $unique_file_name;
        $uploadOk = 1;

         // Cek jika image file asli atau fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan image.";
            $uploadOk = 0;
        }

        // Cek ukuran file 
        if ($_FILES["image"]["size"] > 500000) {
            echo "Maaf, file terlalu besar.";
            $uploadOk = 0;
        }
         // Mengizinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, gambar harus JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

         //  Periksa apakah $uploadOk diatur ke 0 karena kesalahan
        if ($uploadOk == 0) {
            echo "Maaf, file gagal diupload.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;

                // Insert data ke database
                $sql = "INSERT INTO products (kategori_id, nama_produk, harga_produk, image, deskripsi_produk) VALUES ('$kategori_id', '$nama_produk', '$harga_produk', '$image', '$deskripsi_produk')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: tambahproduk.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Maaf, ada kegagalan dalam mengupload file anda.";
            }
        }
    }
}

//edit data===========================================================
if (isset($_POST['edit'])) {
    $produk_id = $_POST['produk_id'];
    $kategori_id = $_POST['kategori_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $image = '';

    // Tangani upload file jika ada gambar baru yang diunggah
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $original_file_name = basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
        $unique_file_name = uniqid() . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $unique_file_name;
        $uploadOk = 1;

         // Periksa apakah file gambar asli atau palsu
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Periksa apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["image"]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Izinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
                // Hapus gambar lama jika gambar baru diunggah
                $query = "SELECT image FROM products WHERE produk_id = $produk_id";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                if (file_exists($row['image'])) {
                    unlink($row['image']);
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            }
        }
    } else {
         // Jika tidak ada gambar baru yang diunggah, gunakan jalur gambar lama
        $query = "SELECT image FROM products WHERE produk_id = $produk_id";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $image = $row['image'];
    }

     // Memperbarui data di database
    $sql = "UPDATE products SET kategori_id = '$kategori_id', nama_produk = '$nama_produk', harga_produk = '$harga_produk', image = '$image', deskripsi_produk = '$deskripsi_produk' WHERE produk_id = $produk_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: tambahproduk.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// delete Data==================================================
if (isset($_POST['delete'])) {
    $produk_id = $_POST['produk_id'];
    $sql = "DELETE FROM products WHERE produk_id = $produk_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: tambahproduk.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
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
    include 'template/admin-menu.php'; 
    ?>
    <!-- akhir nabar -->

    <!-- table -->
    <div id="container">
        <div class="container" style="margin-bottom: 400px; margin-top:50px">
            <button type="button" class="btn text-white bg-dark"
                style="margin-bottom: 20px; margin-top:10px background-color : black;" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Tambah Data
            </button>
            <button type="button" class="btn btn-outline-secondary"
                style="margin-bottom: 20px; margin-top:10px background-color : black;">Print</button>
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
                    <?php if ($result_products): ?>
                    <!-- php urutin nomor -->
                    <?php $i = 1?>
                    <?php while ($row = mysqli_fetch_assoc($result_products)): ?>
                    <tr>
                        <th scope="row"><?=$i?></th>
                        <td><img src="<?= $row['image'] ?>" style="width:100px"></td>
                        <td><?= $row['nama_produk'] ?></td>
                        <td><?= $row['nama_kategori'] ?></td>
                        <td><?= $row['harga_produk'] ?></td>
                        <td><?= $row['deskripsi_produk'] ?></td>
                        <td>
                            <div class='d-flex'>
                                <button type='button' class='btn text-white bg-dark' style='margin-right: 10px;'
                                    data-bs-toggle='modal' data-bs-target='#EditModal<?= $row['produk_id'] ?>'>
                                    Edit
                                </button>
                                <form method='post'>
                                    <input type='hidden' name='produk_id' value='<?= $row['produk_id'] ?>'>
                                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
        </div>
        <!-- akhir table -->

        <!-- edit tambah data -->
        <div class="modal fade" id="EditModal<?= $row['produk_id'] ?>" tabindex="-1"
            aria-labelledby="EditModal<?= $row['produk_id'] ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action='' enctype="multipart/form-data">
                    <input type="hidden" name="produk_id" value="<?= $row['produk_id'] ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="EditModal<?= $row['produk_id'] ?>Label">Edit
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kategori_id">Category</label>
                                <select name="kategori_id" class="form-control" required>
                                    <?php
                                            // setel ulang penunjuk hasil dan ambil kategori lagi
                                            mysqli_data_seek($result_kategori, 0);
                                             while ($kategori = mysqli_fetch_assoc($result_kategori)): ?>
                                    <option value="<?= $kategori['id'] ?>"
                                        <?= ($kategori['id'] == $row['kategori_id']) ? 'selected' : '' ?>>
                                        <?= $kategori['nama_kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_produk">Product Name</label>
                                <input type="text" name="nama_produk" class="form-control"
                                    value="<?= $row['nama_produk'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_produk">Price</label>
                                <input type="number" name="harga_produk" class="form-control"
                                    value="<?= $row['harga_produk'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_produk">Description</label>
                                <textarea name="deskripsi_produk" class="form-control"
                                    required><?= $row['deskripsi_produk'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control">
                                <img src="<?= $row['image'] ?>" style="width:100px; margin-top:10px;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit" class="btn text-white bg-dark">Save
                                changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- php akhir urutin nomor -->
        <?php $i++ ?>
        <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
        </table>
    </div>
    <!-- akhir edit tambah data -->

    <!-- modal Tambah Data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kategori_id">Category</label>
                            <select name="kategori_id" class="form-control" required>
                                <?php
                                mysqli_data_seek($result_kategori, 0); // reset result set to use it again
                                while ($kategori = mysqli_fetch_assoc($result_kategori)): ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_produk">Product Name</label>
                            <input type="text" name="nama_produk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_produk">Price</label>
                            <input type="number" name="harga_produk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_produk">Description</label>
                            <textarea name="deskripsi_produk" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn text-white bg-dark">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- akhir modal tambah data -->

    <!-- footer -->
    <?php
    include 'template/footer.php'
    ?>
    <!-- footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- ajax -->
    <script src="js/admin.js"></script>

</body>

</html>