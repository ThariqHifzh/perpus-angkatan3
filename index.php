<?php
session_start();
// empty() : kosong
if (empty($_SESSION['NAMA'])) {
    header("location:login.php?access=failed");
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <?php include 'inc/navbar.php'; ?>

        <div class="content">
            <?php
            if (isset($_GET['pg'])) {
                if (file_exists('content/' . $_GET['pg'] . '.php')) {
                    include 'content/' . $_GET['pg'] . '.php';
                }
            } else {
                include 'content/dashboard.php';
            }
            ?>
        </div>

        <footer class="fst-italic text-center shadow-sm mt-5 border-top border-black fixed-bottom">
            <div class=" cotainer-xxl">
                <div class="row">
                    <p class="text-center pt-3 pe-4">Copyright &copy 2024 PPKD - Jakarta Pusat</p>
                </div>
        </footer>
    </div>
    <script src=" bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src=" app.js"></script>
</body>

</html>