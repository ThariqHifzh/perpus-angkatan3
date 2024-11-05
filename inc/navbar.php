<div>
    <nav class="navbar navbar-expand-lg border-bottom border-dark">
        <div class="container-fluid">
            <img src="./twitter.png" alt="" style="width: 35px; margin-left: 40px; margin-right: 20px">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold" style="font-size: small;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pg=user">BERANDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?pg=profil">PROFIL</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a style="border: 2px;" class="btn btn-outline-primary rounded-button"
                            onclick="return confirm('Apakah Anda Yakin untuk Log-Out?')" href="./keluar.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <!-- Garis vertikal untuk simbol power -->
                                <line x1="12" y1="2" x2="12" y2="12"></line>
                                <!-- Lingkaran di sekitar garis -->
                                <path d="M16.24 7.76a6 6 0 1 1-8.48 0"></path>
                            </svg>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>