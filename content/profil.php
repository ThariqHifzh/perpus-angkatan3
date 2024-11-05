<?php 
// menampilkan data user berdasarkan id user
$id_user = $_SESSION['ID'];
$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id ='$id_user'");
$rowUser = mysqli_fetch_assoc($queryUser);

$queryTweet = mysqli_query($koneksi, "SELECT * FROM tweet WHERE id ='$id_user'");
$rowTweet = mysqli_fetch_assoc($queryTweet);

if(isset($_POST['simpan'])){
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];

    // jika gambar mau di ubah
if(!empty($_FILES['foto']['name'])){
    $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];

        // png, jpg, jpeg
        $ext = array('png', 'jpg', 'jpeg', 'jfif');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        // JIKA EXTESI FOTO TIDAK ADA YANG TERDAFTAR DI ARRAY EXTENSI
        if (!in_array($extFoto, $ext)) {
            echo "Ext foto tidak ditemukan";
            die;
        } else {
            // Pindahkan gambar dari tmp folder ke folder yang telah kita buat
            // unlink() : mendelete file
            unlink('upload/'.$rowUser['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

            $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna='$nama_pengguna', email='$email', foto='$nama_foto' WHERE id='$id_user'");
        }
} else {
    // gambar tidak mau diubah
    $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna='$nama_pengguna', email='$email' WHERE id='$id_user'");
}
    header("location:?pg=profil&ubah=berhasil");
}



if(isset($_POST['edit_cover'])){

    // jika gambar mau di ubah
if(!empty($_FILES['cover']['name'])){
    $nama_foto = $_FILES['cover']['name'];
        $ukuran_foto = $_FILES['cover']['size'];

        // png, jpg, jpeg
        $ext = array('png', 'jpg', 'jpeg', 'jfif');
        $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

        // JIKA EXTESI FOTO TIDAK ADA YANG TERDAFTAR DI ARRAY EXTENSI
        if (!in_array($extFoto, $ext)) {
            echo "Ext foto tidak ditemukan";
            die;
        } else {
            // Pindahkan gambar dari tmp folder ke folder yang telah kita buat
            // unlink() : mendelete file
            unlink('upload/'.$rowUser['cover']);
            move_uploaded_file($_FILES['cover']['tmp_name'], 'upload/' . $nama_foto);

            $update = mysqli_query($koneksi, "UPDATE user SET cover='$nama_foto' WHERE id='$id_user'");
        }
}
    header("location:?pg=profil&ubah=berhasil");
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="cover">
                <img src="<?php echo !empty($rowUser['cover'])? 'upload/' . $rowUser['cover']: 'https://placehold.co/800x200' ?>"
                    alt="" width="100%" height="330">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile-header mt-5 ms-3">
                <img style="border: 6px solid white;"
                    src="<?php echo !empty($rowUser['foto'])? 'upload/' . $rowUser['foto']: 'https://placehold.co/100x100' ?> "
                    alt="" class="rounded-circle" width="130">
                <h2 class="fw-bold"><?php echo $rowUser['nama_lengkap'] ?> <svg xmlns=" http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="12" fill="#1DA1F2" />
                        <path fill="#fff"
                            d="M10.2 16.2l-3.6-3.6a0.6 0.6 0 0 1 0-.84l1.2-1.2a0.6 0.6 0 0 1 .84 0l2.16 2.16 5.4-5.4a0.6 0.6 0 0 1 .84 0l1.2 1.2a0.6 0.6 0 0 1 0 .84l-6.6 6.6a0.6 0.6 0 0 1-.84 0z" />
                    </svg>
                </h2>
                <p>@<?php echo $rowUser['nama_pengguna'] ?></p>
                <p><?php echo $rowUser['deskripsi'] ?></p>
            </div>
        </div>
        <div class="col-sm-6" align="right">
            <a href="#" class="btn btn-outline-primary fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal"
                style="border-radius: 20px; margin-right: 3px; margin-top: 9rem;">Edit
                Profile</a>
            <a href="#" class="btn btn-outline-primary fw-bold" data-bs-toggle="modal" data-bs-target="#editCover"
                style="border-radius: 20px; margin-right: 1rem; margin-top: 9rem;">Edit
                Cover</a>
        </div>
        <div class="col-sm-12 mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tweet</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tweet &
                        Balasan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Like</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                        type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false"
                        disabled>Disabled</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-4" id="home-tab-pane" role="tabpanel"
                    aria-labelledby="home-tab" tabindex="0"><?php include 'tweet.php'; ?></div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                    tabindex="0">...</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama" name="nama_lengkap"
                            value="<?php echo $rowUser['nama_lengkap'] ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="nama_pengguna"
                            value="<?php echo $rowUser['nama_pengguna'] ?>">
                    </div>
                    <div class="mb-3">
                        <input type="email" class=" form-control" placeholder="Email" name="email"
                            value="<?php echo $rowUser['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="simpan">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Cover -->
<div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Cover</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" class="form-control" name="cover">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit_cover">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>