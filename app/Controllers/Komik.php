<?php

namespace App\Controllers;

use PhpParser\Node\Expr\New_;
use App\Models\KomikModel;
use CodeIgniter\CodeIgniter;
use CodeIgniter\Database\Query;
use Config\App;
use Predis\Command\Argument\Server\To;

class Komik extends BaseController
{
    //atribut
    protected $komikModel;
    //biar ga instansiasi pada setiap method
    public function __construct()
    {
        //instansiasi class model
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        //cara tidak pake construct
        //$KomikModel = new KomikModel();
        //$komik = $KomikModel->findAll();
        //method findAll mencari semua data pada komikModel
        //$komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Komik | Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];
        echo view("komik/index", $data);
    }

    public function detail($slug)
    {
        //$komik = $this->komikModel->getKomik($slug);
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika data komik tidak ada
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('judul komik ' . $slug . ' tidak ditemukan');
        }
        return view('komik/detail', $data);
    }
    // public function detailById($id)
    // {
    //     $data = [
    //         'title' => 'Detail Komik',
    //         'komik' => $this->komikModel->getKomikbyId($id)
    //     ];
    //     return view('komik/detail', $data);
    // }
    public function create()
    {
        //jalankan session agar muncul pesan
        session();
        $data = [
            'title' => 'Form Tambah Buku',
            //kita ambil validation dari save kesini
            'validation' => \Config\Services::validation()
        ];
        return view('komik/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            //field mana ditable mana
            'judul' => 'required|is_unique[komik.judul]'
        ])) {
            $validation = \Config\Services::validation();
            //mngirim semua input, ngirim validationnya
            return redirect()->back()->withInput()->with('validation',$validation);
        }
        //url_title agar url otomatis teksnya kecil semua, kalo ada spasi dikasih '-'
        $slug = url_title($this->request->getVar('judul'), '-', true);
        //getVar ini bisa ngambil method post/get
        //fungsi save jika sudah membuat model
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);
        //flashdata adalah data didalam session yang hanya muncul satu kali
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/komik');
    }
    //kalo kita sudah konek ke model
    public function delete($id)
    {
        $this->komikModel->delete($id);
        return redirect()->to('/komik');
    }
}
