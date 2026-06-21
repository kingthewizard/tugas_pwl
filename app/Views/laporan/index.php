<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="text-emerald">Laporan Penjualan (7 Hari Terakhir)</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?= base_url('laporan/pdf') ?>" class="btn btn-outline-danger me-2" target="_blank">
            <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
        </a>
        <a href="<?= base_url('laporan/excel') ?>" class="btn btn-outline-success">
            <i class="bi bi-file-earmark-excel-fill"></i> Export Excel
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <canvas id="salesChart" height="100"></canvas>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th class="text-end">Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                foreach ($dailySales as $sale) : 
                    $grandTotal += $sale['total'];
                ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($sale['tanggal'])) ?></td>
                        <td class="text-end fw-semibold text-emerald">Rp <?= number_format($sale['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($dailySales)) : ?>
                    <tr>
                        <td colspan="2" class="text-center text-muted py-3">Belum ada data penjualan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot class="table-group-divider">
                <tr>
                    <th class="fs-5">Total Keseluruhan</th>
                    <th class="text-end fs-5 text-emerald">Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Prepare Data
    const rawData = <?= json_encode($dailySales) ?>;
    const labels = rawData.map(item => item.tanggal);
    const data = rawData.map(item => parseInt(item.total));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan Harian (Rp)',
                data: data,
                backgroundColor: 'rgba(16, 185, 129, 0.2)', // emerald transparent
                borderColor: '#10b981', // emerald
                borderWidth: 2,
                pointBackgroundColor: '#059669',
                pointRadius: 4,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            }
        }
    });
});
</script>
<?= $this->endSection() ?>
