<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-emerald text-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Pesanan #<?= esc($order['id']) ?></h5>
                <span class="badge bg-light text-emerald"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></span>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-muted mb-1">Atas Nama Pelanggan:</h6>
                    <h4 class="fw-bold"><?= esc($order['atas_nama']) ?></h4>
                </div>
                
                <h6 class="text-muted mb-3 border-bottom pb-2">Rincian Menu:</h6>
                
                <div class="table-responsive mb-4">
                    <table class="table table-borderless table-sm">
                        <thead class="border-bottom">
                            <tr>
                                <th>Menu</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td>
                                        <span class="fw-semibold d-block"><?= esc($item['nama']) ?></span>
                                        <small class="text-muted"><?= esc($item['kategori']) ?></small>
                                    </td>
                                    <td class="text-center align-middle"><?= esc($item['jumlah']) ?>x</td>
                                    <td class="text-end align-middle">Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                                    <td class="text-end align-middle fw-semibold">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <th colspan="3" class="text-end pt-3 fs-5">Total Pembayaran:</th>
                                <th class="text-end pt-3 fs-5 text-emerald">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="text-center">
                    <a href="<?= base_url('pesanan/history') ?>" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
