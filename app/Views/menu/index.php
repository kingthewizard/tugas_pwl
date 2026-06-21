<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row mb-3">
    <div class="col">
        <h2 class="mb-0">Daftar Menu Burjo</h2>
    </div>
    <?php if (session()->get('isLoggedIn')) : ?>
        <div class="col text-end">
            <a href="<?= base_url('menu/create') ?>" class="btn btn-emerald">
                <i class="bi bi-plus-circle me-1"></i> Tambah Menu
            </a>
        </div>
    <?php endif; ?>
</div>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('pesan') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center" style="width: 5%">#</th>
                        <th scope="col" style="width: 25%">Nama Menu</th>
                        <th scope="col" style="width: 15%">Kategori</th>
                        <th scope="col" style="width: 15%">Harga</th>
                        <th scope="col" style="width: 25%">Deskripsi</th>
                        <?php if (session()->get('isLoggedIn')) : ?>
                            <th scope="col" class="text-center" style="width: 15%">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menus as $m) : ?>
                        <tr>
                            <th scope="row" class="text-center align-middle"><?= $i++ ?></th>
                            <td class="align-middle fw-semibold"><?= esc($m['nama']) ?></td>
                            <td class="align-middle">
                                <?php if ($m['kategori'] == 'Makanan') : ?>
                                    <span class="badge text-bg-warning"><?= esc($m['kategori']) ?></span>
                                <?php else : ?>
                                    <span class="badge text-bg-info"><?= esc($m['kategori']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">Rp <?= number_format($m['harga'], 0, ',', '.') ?></td>
                            <td class="align-middle text-muted small"><?= esc($m['deskripsi']) ?></td>
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('menu/edit/' . $m['id']) ?>" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="<?= base_url('menu/' . $m['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?');" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($menus)) : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada menu yang ditambahkan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
