<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Menu extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new \App\Models\MenuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Menu - Warkop Burjo',
            'menus' => $this->menuModel->orderBy('kategori', 'ASC')->orderBy('nama', 'ASC')->findAll()
        ];
        return view('menu/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Menu - Warkop Burjo'
        ];
        return view('menu/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[255]',
            'kategori' => 'required|in_list[Makanan,Minuman]',
            'harga'    => 'required|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->menuModel->save([
            'nama'      => $this->request->getPost('nama'),
            'kategori'  => $this->request->getPost('kategori'),
            'harga'     => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/menu')->with('pesan', 'Menu berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to('/menu');
        }

        $menu = $this->menuModel->find($id);
        if (!$menu) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Menu dengan ID $id tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Menu - Warkop Burjo',
            'menu'  => $menu
        ];
        return view('menu/edit', $data);
    }

    public function update($id = null)
    {
        if ($id === null) {
            return redirect()->to('/menu');
        }

        $rules = [
            'nama'     => 'required|min_length[3]|max_length[255]',
            'kategori' => 'required|in_list[Makanan,Minuman]',
            'harga'    => 'required|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->menuModel->update($id, [
            'nama'      => $this->request->getPost('nama'),
            'kategori'  => $this->request->getPost('kategori'),
            'harga'     => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/menu')->with('pesan', 'Menu berhasil diupdate.');
    }

    public function delete($id = null)
    {
        if ($id !== null) {
            $this->menuModel->delete($id);
            return redirect()->to('/menu')->with('pesan', 'Menu berhasil dihapus.');
        }
        return redirect()->to('/menu');
    }
}
