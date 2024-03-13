<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Home extends BaseController
{

    public function index()
    {
        $model = new KomikModel();
        $judul = $model->findAll();
        //memanggil sebuah file bernama welocome_message didalam folder view
    
    }
    public function coba($nama = '', $umur = '')
    {
        echo "Halo nama saya $nama, umur saya $umur";
        return "hello world";
    }

    // public function Database()
    // {
    //     $db = db_connect();
    //     $query = $db->query('SELECT * FROM komik');
    //     $result = $query->getResult();

    //     foreach ($result as $k) {
    //         echo $k->judul;
    //         echo $k->penerbit;
    //         echo $k->penulis;
    //     }
    // }
}
