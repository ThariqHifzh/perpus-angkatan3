 <?php
 include 'koneksi.php';
//  jika button daftar di klik

if (isset($_POST['daftar'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pengguna = $_POST['nama_pengguna'];

    // Masukkan data ke dalam tbl user kolom kolom tbl user () dan nilainya di ambil dari inputan sesuai dengan urutan kolomnya
    mysqli_query($koneksi, "INSERT INTO pengguna (email, password, nama_lengkap, nama_pengguna) VALUES ('$email','$password','$nama_lengkap','$nama_pengguna')");

    // melempar ke halaman login
    header("location:login.php?register=berhasil");
}
 
 ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title>
     <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
 </head>

 <body>
     <div class="wrapper">
         <div class="container">
             <div class="row">
                 <div class="col-sm-4 mx-auto">
                     <div class="card" style="margin-top: 180px;">
                         <div class="card-body">
                             <div class="card-title text-center">
                                 <h2 class="fw-bold text-primary" style="letter-spacing: -2px;">
                                     <img src="./twitter.png" alt=""
                                         style="width: 35px; margin-right: 10px; margin-bottom: 10px">Twitter
                                 </h2>
                                 <p>Silahkan masuk dengan akun anda</p>
                             </div>
                             <form action="" method="post">
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Email</label>
                                     <input type="text" class="form-control" name="email"
                                         placeholder="Masukan email anda">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Password</label>
                                     <input type="password" class="form-control" name="password"
                                         placeholder="Masukkan Password">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Fullname</label>
                                     <input type="text" class="form-control" name="nama_lengkap"
                                         placeholder="Masukan Nama Lengkap">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">Username</label>
                                     <input type="text" class="form-control" name="nama_pengguna"
                                         placeholder="Masukan Username">
                                 </div>
                                 <div class="form-group mb-3">
                                     <div class="d-grid">
                                         <button name="daftar" type="submit" class="btn btn-primary">Register</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>


                     <div class="card mt-3">
                         <div class="card-body">
                             <p class="text-center">Sudah punya akun? <a href="test-secondary">Buat Akun</a></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </body>

 </html>