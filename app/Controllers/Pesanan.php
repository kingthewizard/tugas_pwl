<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pesanan extends BaseController
{
    protected $menuModel;
    protected $orderModel;
    protected $orderItemModel;

    public function __construct()
    {
        $this->menuModel = new \App\Models\MenuModel();
        $this->orderModel = new \App\Models\OrderModel();
        $this->orderItemModel = new \App\Models\OrderItemModel();
    }

    public function create()
    {
        $data = [
            'title' => 'Buat Pesanan Baru',
            'menus' => $this->menuModel->orderBy('kategori', 'ASC')->orderBy('nama', 'ASC')->findAll()
        ];
        return view('pesanan/create', $data);
    }

    public function store()
    {
        $atas_nama = $this->request->getPost('atas_nama');
        $items = $this->request->getPost('items'); // array: menu_id => jumlah

        if (empty($atas_nama) || empty($items)) {
            return redirect()->back()->with('error', 'Nama pelanggan dan minimal satu pesanan harus diisi!');
        }

        $total_harga = 0;
        $order_items = [];

        foreach ($items as $menu_id => $jumlah) {
            if ($jumlah > 0) {
                $menu = $this->menuModel->find($menu_id);
                if ($menu) {
                    $subtotal = $menu['harga'] * $jumlah;
                    $total_harga += $subtotal;

                    $order_items[] = [
                        'menu_id'      => $menu_id,
                        'jumlah'       => $jumlah,
                        'harga_satuan' => $menu['harga'],
                        'subtotal'     => $subtotal
                    ];
                }
            }
        }

        if (empty($order_items)) {
            return redirect()->back()->with('error', 'Minimal satu pesanan harus lebih dari 0!');
        }

        // Insert Order
        $this->orderModel->insert([
            'atas_nama'   => $atas_nama,
            'total_harga' => $total_harga
        ]);
        
        $order_id = $this->orderModel->insertID();

        // Insert Order Items
        foreach ($order_items as &$item) {
            $item['order_id'] = $order_id;
        }
        $this->orderItemModel->insertBatch($order_items);

        return redirect()->to('/pesanan/create')->with('success', "Pesanan atas nama $atas_nama berhasil disimpan! Total: Rp " . number_format($total_harga, 0, ',', '.'));
    }

    public function history()
    {
        $data = [
            'title'  => 'Daftar Pesanan',
            'orders' => $this->orderModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('pesanan/history', $data);
    }

    public function detail($id = null)
    {
        if ($id === null) {
            return redirect()->to('/pesanan/history');
        }

        $order = $this->orderModel->find($id);
        if (!$order) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pesanan tidak ditemukan");
        }

        // Get order items joined with menu
        $db = \Config\Database::connect();
        $builder = $db->table('order_items');
        $builder->select('order_items.*, menu.nama, menu.kategori');
        $builder->join('menu', 'menu.id = order_items.menu_id');
        $builder->where('order_items.order_id', $id);
        
        $data = [
            'title' => 'Detail Pesanan #' . $id,
            'order' => $order,
            'items' => $builder->get()->getResultArray()
        ];

        return view('pesanan/detail', $data);
    }
}