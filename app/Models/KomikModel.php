<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table = 'komik';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];
    //kalo ada parameternya cari pake where
    //kalo gada, tampilkan semuanya
    public function getKomik($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
    //Mengambil data table komik berdasarkan id
    // public function getKomikbyId($id = false)
    // {
    //     if ($id === false) {
    //         return $this->findAll();
    //     }
    //     return $this->where(['id' => $id])->first();
    // }
}
