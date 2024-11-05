<?php

if (isset($_POST['posting'])) {
    $content = $_POST['content'];

    // jika gambar mau di ubah
    if (!empty($_FILES['foto']['name'])) {
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
            unlink('upload/' . $rowTweet['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

            $insert = mysqli_query($koneksi, "INSERT INTO tweet (content, id_user, foto) VALUES('$content', '$id_user', '$nama_foto')");
        }
    } else {
        // gambar tidak mau diubah
        $insert = mysqli_query($koneksi, "INSERT INTO tweet (content, id_user) VALUES('$content', '$id_user')");
    }
    header("location:?pg=profil&tweet=berhasil");
}

$queryPosting = mysqli_query($koneksi, "SELECT tweet.* FROM tweet WHERE id_user = '$id_user'");

?>
<div class="row">
    <div class="col-sm-12" align="right">
        <a href="#" class="btn btn-primary fw-bold ps-5 pe-5" data-bs-toggle="modal" data-bs-target="#tweet"
            style="border-radius: 20px; font-size:small">Tweet</a>
    </div>
    <div class="col-sm-12 mt-3">
        <?php while ($rowPosting = mysqli_fetch_assoc($queryPosting)): ?>
        <div class="">
            <div class="d-flex">
                <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : '' ?>" alt="..." width="50"
                    class="border border-2 rounded-circle">
                <div class="ms-2">
                    <h6 class="fw-bold mb-0"><?php echo $rowUser['nama_lengkap'] ?> <svg
                            xmlns=" http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="12" fill="#1DA1F2" />
                            <path fill="#fff"
                                d="M10.2 16.2l-3.6-3.6a0.6 0.6 0 0 1 0-.84l1.2-1.2a0.6 0.6 0 0 1 .84 0l2.16 2.16 5.4-5.4a0.6 0.6 0 0 1 .84 0l1.2 1.2a0.6 0.6 0 0 1 0 .84l-6.6 6.6a0.6 0.6 0 0 1-.84 0z" />
                        </svg></h6>
                    <p class="mb-0" style="font-size:medium">@<?php echo $rowUser['nama_pengguna'] ?></p>
                </div>
            </div>
            <div class="flex-grow-1 ms-5 mt-3">
                <?php echo $rowPosting['content'] ?>
                <?php if (!empty($rowPosting['foto'])): ?>
                <img src="upload/<?php echo $rowPosting['foto'] ?>" alt="" width="300" style="border-radius: 20px">
                <?php endif ?>
            </div>
            <!-- button komen -->
            <div class="flex-grow-1 ms-3 mt-4">
                <form action="add_comment.php" method="post">
                    <input type="text" hidden name="status_id" value="<?php echo $rowPosting['id'] ?>">
                    <input type="text" hidden name="user_id" value="<?php echo $rowPosting['id_user'] ?>">
                    <textarea class="form-control" name="comment_text" id="comment_text" cols="5" rows="5"
                        placeholder="Tuliskan Komentar..."></textarea>
                    <button class="btn btn-primary btn-sm mt-2" type="submit">Kirim Balasan</button>
                </form>
                <!-- Like -->
                <div class="status mt-1">
                    <input type="text" id="user_id_like" value="<?php echo $rowPosting['id_user'] ?>">
                    <button class="btn btn-success" onclick="toggleLike(<?php echo $rowPosting['id']; ?>)">Like
                        (1)</button>
                </div>
                <!-- balas pesan -->
                <div class="mt-2 alert" id="comment-alert" style="display: none;"></div>
                <div class="mt-3">
                    <?php
                        if (isset($rowPosting['id']) && isset($rowPosting['id_user'])) {
                            $idStatus = $rowPosting['id'];
                            $userId = $rowPosting['id_user'];
                            $queryComment = mysqli_query($koneksi, "SELECT * FROM comments 
                                        WHERE status_id = $idStatus AND user_id = '$userId'");
                            $rowCounts = mysqli_fetch_all($queryComment, MYSQLI_ASSOC);
                            // var_dump($rowCounts);
                            foreach ($rowCounts as $rowCount) {
                        ?>
                    <span class=" d-flex">
                        <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : '' ?>" alt="..."
                            width="25" class="border border-2 rounded-circle me-2">
                        <p class="fw-bold mb-0 me-2"><?php echo $rowUser['nama_lengkap'] ?>
                        <p class="mb-0 text-dark opacity-50" style="">@<?php echo $rowUser['nama_pengguna'] ?></p>
                    </span>
                    <p class="mb-3 mt-2 ms-4" style="font-size: 18px"><?php echo $rowCount['comment_text'] ?></p>
                    <?php
                            }
                        } ?>
                </div>
            </div>
        </div>
        <hr>
        <?php endwhile ?>
    </div>

</div>

<!-- Modal -->
<div class=" modal fade" id="tweet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tweet</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <textarea name="content" id="summernote" class="form-control"
                            placeholder="Mau nge Tweet apa?"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="posting">Posting</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleLike(statusId) {
    const userId = document.getElementById('user_id_like').value;
    fetch("like_status.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `status_id=${statusId}&user_id=${userId}`

        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "liked") {
                alert("Liked!");
            } else if (data.status === "unliked") {
                alert("Unliked!");
            }
            location.reload();
        })
        .catch(error => console.error("Error:", error));
}
</script>

<!-- <script>
document.getElementById('comment-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("add_comment.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const alertBox = document.getElementById('comment-alert');
            if (data.status === "success") {
                alertBox.className = "alert alert-success";
                alertBox.innerHTML = data.message;

                // bersihkan textarea
                document.getElementById('comment_text').value = '';
                location.reload();
            } else {
                alertBox.className = "alert alert-danger";
                alertBox.innerHTML = data.message;
            }
            alertBox.style.display = "block";
        })
        .catch(error => console.error('Error:', error));
})
</script> -->