<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new \App\Models\OrderModel();
    }

    public function index()
    {
        $dailySales = $this->orderModel->getDailySales(7); // Last 7 days

        $data = [
            'title' => 'Laporan Penjualan',
            'dailySales' => $dailySales
        ];

        return view('laporan/index', $data);
    }

    public function exportPdf()
    {
        $dailySales = $this->orderModel->getDailySales(30); // Last 30 days for report

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('laporan/pdf_template', ['sales' => $dailySales]));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan_Penjualan_Burjo.pdf', ['Attachment' => true]);
    }

    public function exportExcel()
    {
        $dailySales = $this->orderModel->getDailySales(30);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'Laporan Penjualan Warkop Burjo');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        $sheet->setCellValue('A3', 'Tanggal');
        $sheet->setCellValue('B3', 'Total Penjualan (Rp)');
        $sheet->getStyle('A3:B3')->getFont()->setBold(true);

        $row = 4;
        $grandTotal = 0;
        foreach ($dailySales as $sale) {
            $sheet->setCellValue('A' . $row, $sale['tanggal']);
            $sheet->setCellValue('B' . $row, $sale['total']);
            $grandTotal += $sale['total'];
            $row++;
        }

        $sheet->setCellValue('A' . $row, 'Total Keseluruhan');
        $sheet->setCellValue('B' . $row, $grandTotal);
        $sheet->getStyle('A' . $row . ':B' . $row)->getFont()->setBold(true);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Laporan_Penjualan_Burjo.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
