<?php

namespace App\Controllers;

class Welcome extends BaseController
{
    public function __construct()
    {
        // Load helper functions
        helper(['date', 'html', 'number']);
    }

    public function index()
    {
        echo now();
        echo "</br>";
        echo date('Y-m-d H:i:s');
        echo "</br>";
        echo timezone_select(now());
        echo "</br>";
        echo mailto('google.com', 'Contact Us');
        echo "</br>";
        echo auto_link('Visit us at http://localhost:8080/komik');
        echo "</br>";
        echo number_format('1000000000');
        echo "</br>";
        echo number_to_size('1000000000');
        echo "</br>";
        echo number_to_currency(1234.56, 'YEN', 'ja_jp', 2);
        echo "</br>";
        echo number_to_roman(10);
    }
}
