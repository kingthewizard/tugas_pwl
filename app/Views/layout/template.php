<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-act">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Burjo Web App' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f0fdf4; /* Light emerald background */
        }
        .navbar-brand {
            font-weight: bold;
        }
        /* Custom Emerald Theme */
        .bg-emerald {
            background-color: #10b981 !important;
            color: white;
        }
        .text-emerald {
            color: #10b981 !important;
        }
        .btn-emerald {
            background-color: #10b981;
            color: white;
            border: none;
        }
        .btn-emerald:hover {
            background-color: #059669;
            color: white;
        }
        .btn-outline-emerald {
            color: #10b981;
            border-color: #10b981;
        }
        .btn-outline-emerald:hover {
            background-color: #10b981;
            color: white;
        }
    </style>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-emerald mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>"><i class="bi bi-cup-hot-fill me-2"></i>Warkop Burjo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('menu') && !url_is('menu/*')) ? 'active' : '' ?>" href="<?= base_url('menu') ?>">Daftar Menu</a>
                    </li>
                    <?php if (!session()->get('isLoggedIn')) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= (url_is('pesanan/create')) ? 'active' : '' ?>" href="<?= base_url('pesanan/create') ?>">Buat Pesanan</a>
                        </li>
                    <?php endif; ?>
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= (url_is('pesanan/history*') || url_is('pesanan/detail*')) ? 'active' : '' ?>" href="<?= base_url('pesanan/history') ?>">Riwayat Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (url_is('laporan*')) ? 'active' : '' ?>" href="<?= base_url('laporan') ?>">Laporan Penjualan</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout (Admin)</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold" href="<?= base_url('login') ?>"><i class="bi bi-box-arrow-in-right"></i> Login Admin</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmxc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
