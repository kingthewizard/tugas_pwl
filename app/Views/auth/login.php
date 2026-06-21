<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Login Admin' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f0fdf4;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            height: 100vh;
        }
        .form-signin {
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }
        .text-emerald { color: #10b981 !important; }
        .bg-emerald { background-color: #10b981 !important; color: white; }
        .btn-emerald { background-color: #10b981; color: white; border: none; }
        .btn-emerald:hover { background-color: #059669; color: white; }
    </style>
  </head>
  <body class="text-center">
    <main class="form-signin w-100">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <i class="bi bi-person-circle text-emerald mb-3" style="font-size: 4rem;"></i>
                <h1 class="h3 mb-3 fw-normal text-emerald fw-bold">Login Admin</h1>
                <p class="text-muted small mb-4">Silahkan Login untuk melanjutkan.</p>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger p-2 small">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login/process') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-4 text-start">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-emerald" type="submit">Masuk</button>
                </form>
                
                <div class="mt-4">
                    <a href="<?= base_url('pesanan/create') ?>" class="text-decoration-none text-muted small"><i class="bi bi-arrow-left"></i> Kembali ke Kasir</a>
                </div>
            </div>
        </div>
        <p class="mt-4 mb-3 text-muted">&copy; 2026 Warkop Burjo</p>
    </main>
  </body>
</html>
