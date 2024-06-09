<?php
include 'lib/connection.php';
include 'lib/checklogin.php';

$query = 'select * from kategori';
$result_kategori = mysqli_query($conn, $query);

// tambah data=====================================================
if (isset($_POST['tambah'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_kategori = $_POST['nama_kategori'];

        // Handle file upload
        $target_dir = "uploads/";
        $original_file_name = basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
        $unique_file_name = uniqid() . '_' . time() . '.' . $imageFileType; 
        $target_file = $target_dir . $unique_file_name;
        $uploadOk = 1;

        // Cek jika image file asli atau fake image
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Cek jika file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        // Cek ukuran file
        if ($_FILES["gambar"]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Mengizinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        //  Periksa apakah $uploadOk diatur ke 0 karena kesalahan
        if ($uploadOk == 0) {
            echo "Maaf, gagal teruploud.";
        } else {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $gambar = $target_file;

                // Insert data ke database
                $sql = "INSERT INTO kategori (nama_kategori, gambar) VALUES ('$nama_kategori', '$gambar')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: tambahkategori.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            }
        }
    }
}

//edit data===============================================
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_kategori = $_POST['nama_kategori'];
    $gambar = '';

    // Tangani upload file jika ada gambar baru yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/";
        $original_file_name = basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
        $unique_file_name = uniqid() . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $unique_file_name;
        $uploadOk = 1;

        // Periksa apakah file gambar asli atau palsu
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
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
        if ($_FILES["gambar"]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Izinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $gambar = $target_file;
                // Hapus gambar lama jika gambar baru diunggah
                $query = "SELECT gambar FROM kategori WHERE id = $id";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                if (file_exists($row['gambar'])) {
                    unlink($row['gambar']);
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
            }
        }
    } else {
        // Jika tidak ada gambar baru yang diunggah, gunakan jalur gambar lama
        $query = "SELECT gambar FROM kategori WHERE id = $id";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $gambar = $row['gambar'];
    }

    // Memperbarui data di database
    $sql = "UPDATE kategori SET nama_kategori = '$nama_kategori', gambar = '$gambar' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: tambahkategori.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

// delete Data=============================================
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    
    $sql = "DELETE FROM kategori WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: tambahkategori.php");
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
    include 'template/admin-menu.php'
    ?>
    <!-- navbar end==== -->

    <div class="container" style="margin-bottom: 400px; margin-top:50px">

        <!-- tabel -->
        <button type="button" class="btn text-white bg-dark"
            style="margin-bottom: 20px; margin-top:10px background-color : black;" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Tambah Data
        </button>
        <table class="table table-striped table-hover table-bordered">
            <thead class="tread-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_kategori):?>
                <!-- php urutin nomor -->
                <?php $i = 1?>
                <?php while ($row = mysqli_fetch_assoc($result_kategori)):?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><img src="<?=$row['gambar']?>" style="width:100px"></td>
                    <td><?=$row['nama_kategori']?></td>
                    <td>
                        <div class='d-flex'>
                            <button type='button' class='btn text-white bg-dark' style='margin-right: 10px;'
                                data-bs-toggle='modal' data-bs-target='#EditModal<?=$row['id']?>'>
                                Edit Data
                            </button>
                            <form method='post'>
                                <input type='hidden' name='id' value='<?=$row['id']?>'>
                                <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <!-- akhir table -->

                <!-- edit data -->
                <div class="modal fade" id="EditModal<?=$row['id']?>" tabindex="-1"
                    aria-labelledby="EditModal<?=$row['id']?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action='' enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$row['id']?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="EditModalLabel">Edit Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" name='nama_kategori' class="form-control"
                                            value="<?=$row['nama_kategori']?>">
                                        <div id="emailHelp" class="form-text">Add your image here.</div>
                                    </div>
                                    <div class="mb-3">
                                        <img src="<?=$row['gambar']?>" style="width:100px">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input class="form-control" type="file" name='gambar' id="formFile">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit" class="btn text-white bg-dark">Save
                                        changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- php akhir urutin nomor -->
                <?php $i++?>
                <?php endwhile?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <!-- edit data end -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action='' enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name='nama_kategori' class="form-control">
                            <div id="emailHelp" class="form-text">Add your image here.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input class="form-control" type="file" name='gambar' id="formFile">
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
    <!-- akhir modal  -->

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