<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0">Tambah Menu Baru</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('menu/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" required autofocus>
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select <?= (session('errors.kategori')) ? 'is-invalid' : '' ?>" id="kategori" name="kategori" required>
                                <option value="" disabled selected>Pilih Kategori...</option>
                                <option value="Makanan" <?= (old('kategori') == 'Makanan') ? 'selected' : '' ?>>Makanan</option>
                                <option value="Minuman" <?= (old('kategori') == 'Minuman') ? 'selected' : '' ?>>Minuman</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors.kategori') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?= (session('errors.harga')) ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= old('harga') ?>" min="0" required>
                            <div class="invalid-feedback">
                                <?= session('errors.harga') ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi') ?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('menu') ?>" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-emerald">Simpan Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
