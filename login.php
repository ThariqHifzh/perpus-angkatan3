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
                     <div class="card" style="margin-top: 200px;">
                         <div class=" card-body">
                             <div class="card-title text-center">
                                 <h2 class="fw-bold text-primary" style="letter-spacing: -2px;">
                                     <img src="./twitter.png" alt=""
                                         style="width: 35px; margin-right: 10px; margin-bottom: 10px">Twitter
                                 </h2>
                                 <p>Silahkan masuk dengan akun anda</p>
                             </div>
                             <?php if(isset($_GET['register'])): ?>
                             <div class="alert alert-warning">Registrasi Pengguna Berhasil</div>
                             <?php endif ?>
                             <form action="actionLogin.php" method="post">
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">
                                         Email
                                     </label>
                                     <input type="text" class="form-control" name="email"
                                         placeholder="Masukan email anda">
                                 </div>
                                 <div class="form-group mb-3">
                                     <label for="" class="form-label">
                                         Password
                                     </label>
                                     <input type="password" class="form-control" name="password"
                                         placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                 </div>
                                 <div class="form-goup mb-3">
                                     <div class="d-grid">
                                         <button type="submit" class="btn btn-primary">Masuk</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <div class="card mt-3">
                         <div class="card-body">
                             <p class="text-center">Sudah punya akun?<a href="register.php" class="text-secondary">Buat
                                     Akun</a></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </body>

 </html>