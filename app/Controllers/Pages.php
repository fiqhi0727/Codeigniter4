<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function home()
    {
        $data = [
            'title' => 'Home | Komik'
        ];
        echo view("pages/home", $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About | Komik'
        ];

        echo view("pages/about", $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact Me | Web CI4'
        ];
        echo view("pages/contact", $data);
    }
}
