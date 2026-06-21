<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        h2 {
            text-align: center;
            color: #10b981;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Warkop Burjo</h2>
    <p>Dicetak pada: <?= date('d M Y H:i') ?></p>
    
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grandTotal = 0;
            foreach ($sales as $sale) : 
                $grandTotal += $sale['total'];
            ?>
                <tr>
                    <td><?= date('d M Y', strtotime($sale['tanggal'])) ?></td>
                    <td class="text-right">Rp <?= number_format($sale['total'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($sales)) : ?>
                <tr>
                    <td colspan="2" style="text-align: center;">Belum ada data penjualan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td>Total Keseluruhan</td>
                <td class="text-right">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
