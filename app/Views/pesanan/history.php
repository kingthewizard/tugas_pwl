<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="text-emerald">Riwayat Daftar Pesanan</h2>
        <p class="text-muted">Semua daftar transaksi pesanan yang telah dibuat.</p>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 30%">Waktu Pemesanan</th>
                        <th scope="col" style="width: 30%">Atas Nama</th>
                        <th scope="col" style="width: 20%">Total Harga</th>
                        <th scope="col" class="text-center" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td class="align-middle fw-semibold">#<?= esc($order['id']) ?></td>
                            <td class="align-middle"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></td>
                            <td class="align-middle"><?= esc($order['atas_nama']) ?></td>
                            <td class="align-middle text-emerald fw-bold">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                            <td class="text-center align-middle">
                                <a href="<?= base_url('pesanan/detail/' . $order['id']) ?>" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($orders)) : ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada riwayat pesanan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
