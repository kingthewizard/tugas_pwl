<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4 text-emerald">Kasir - Buat Pesanan</h2>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('pesanan/store') ?>" method="post" id="form-pesanan">
            <?= csrf_field() ?>
            
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label for="atas_nama" class="form-label fw-bold">Atas Nama Pelanggan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg border-emerald" id="atas_nama" name="atas_nama" required placeholder="Masukkan nama pelanggan...">
                        </div>
                        <div class="col-md-6 text-end">
                            <h3 class="mb-0 text-muted">Total Bayar: <br><strong class="text-emerald fs-1" id="total-display">Rp 0</strong></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach ($menus as $m) : ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold mb-0"><?= esc($m['nama']) ?></h5>
                                    <span class="badge <?= ($m['kategori'] == 'Makanan') ? 'text-bg-warning' : 'text-bg-info' ?>">
                                        <?= esc($m['kategori']) ?>
                                    </span>
                                </div>
                                <h6 class="card-subtitle mb-3 text-emerald fw-bold">Rp <?= number_format($m['harga'], 0, ',', '.') ?></h6>
                                <p class="card-text text-muted small"><?= esc($m['deskripsi']) ?></p>
                                
                                <div class="mt-auto">
                                    <label class="form-label small fw-bold">Jumlah Pesanan:</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary btn-minus" type="button">-</button>
                                        <input type="number" class="form-control text-center input-jumlah" name="items[<?= $m['id'] ?>]" value="0" min="0" data-harga="<?= $m['harga'] ?>" readonly>
                                        <button class="btn btn-outline-emerald btn-plus" type="button">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="sticky-bottom bg-white p-3 border-top shadow mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-emerald btn-lg px-5 fw-bold" id="btn-simpan" disabled>Simpan Pesanan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.input-jumlah');
    const totalDisplay = document.getElementById('total-display');
    const btnSimpan = document.getElementById('btn-simpan');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    function hitungTotal() {
        let total = 0;
        let totalItems = 0;
        inputs.forEach(input => {
            const val = parseInt(input.value) || 0;
            const harga = parseInt(input.getAttribute('data-harga')) || 0;
            total += (val * harga);
            totalItems += val;
        });
        totalDisplay.innerHTML = formatRupiah(total);
        
        if (totalItems > 0) {
            btnSimpan.removeAttribute('disabled');
        } else {
            btnSimpan.setAttribute('disabled', 'disabled');
        }
    }

    document.querySelectorAll('.btn-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.nextElementSibling;
            let val = parseInt(input.value) || 0;
            if (val > 0) {
                input.value = val - 1;
                hitungTotal();
            }
        });
    });

    document.querySelectorAll('.btn-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            let val = parseInt(input.value) || 0;
            input.value = val + 1;
            hitungTotal();
        });
    });
});
</script>
<?= $this->endSection() ?>
