
# Selamat Datang di Codeigniter 4
## Fiqhi Rainalzi
## 220202035
## TI 2B

Sebelumnya apa itu Framework? Framework adalah kerangka kerja yang digunakan untuk mengembangkan aplikasi berbasis website.
**Codeigniter4** adalah salah satu Framework pada bahasa php

## Requerment

- PHP 7.4 atau lebih baru
- Database MySQL versi 5.1+




## Installation
### Composer Installation
- download composer versi terbaru di https://getcomposer.org/download/ 
- lakukan instalasi composer
- lakukan perintah **composer** pada terminal untuk mengecek apakah composer sudah terintall atau belum
- lakukan perintah ini pada terminal untuk menginstall Codeigniter 4 
```bash
  composer create-project codeigniter4/appstarter namaproject -vvv
```
- **create project** untuk membuat project baru
- **codeigniter4/appstarter** file CI yang akan didownload
- **nama-project** bebas nama apa yang akan dibuat
- **-vvv** ini untuk melihat secara detail ketika mengintall codeigniter4
### Manual Installation
- download codeigniter4 pada laman resmi di https://codeigniter.com/download
- extract file codeigniter4, bebas difolder mana (laragon)
- jika menggunakan XAMPP taruh file pada htdocs
### Troubleshooting

Troubleshooting adalah proses mengidentifikasi, menganalisis, dan memecahkan masalah atau kesalahan yang mungkin terjadi dalam pengembangan atau pengoperasian aplikasi berbasis CodeIgniter 4
#### cara kita tau bahwa ci4 kita sudah terinstal
-  dengan memasukan perintah ini pada terminal
```bash
php spark serve
```
-lalu buka localhost, default localhostnya  **http://localhost:8080**

#### aku harus menginputkan index.php di URL
- cara agar tidak harus menginputkan index.php
- pergi ke **app/config/App.php**
- cari bagian **$indexPage**
- kosongkan nilainya
```PHP
public string $indexPage = '';
```


## Build Your First Application
### Static Page
Static pages) merujuk pada halaman-halaman dalam sebuah aplikasi web yang memiliki konten tetap dan tidak berubah secara dinamis berdasarkan permintaan pengguna atau data dari database. Halaman-halaman statis ini biasanya tidak memerlukan pemrosesan logika atau akses ke database, dan kontennya sudah ditentukan sebelumnya.
#### Setting Routing Rules
- Buka file rute yang terletak di **app/Config/Routes.php.**
- Satu-satunya arahan rute di sana untuk memulai adalah:
```php
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
```
- artinya bahwa setiap permintaan yang masuk tanpa konten '/' akan menjalankan Controller Home method index
- namun ada beberapa routes yang saya sudah buat
```php
$routes->get('coba', 'Coba::index');
$routes->get('/komik/index', 'Komik::index');
$routes->get('/komik/create', 'Komik::create');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
//kalo misalkan user akes komik/apapun, kita arahkan ke controller komik methodnya detail
$routes->get('/komik/(:any)', 'Komik::detail/$1');
$routes->setAutoRoute(true);
```
- **$routes->get('coba', 'Coba::index');** menangani ketika ada reques coba akan ke controller Coba methodnya index
- **$routes->get('/komik/index', 'Komik::index');** menangani request ketika url menuju ke komik/index akan memuat controler Komik methodnya index
- **$routes->get('/komik/create', 'Komik::create');** menangani request komik/create akan memuat controller Komik methodnya create
- **$routes->delete('/komik/(:num)', 'Komik::delete/$1');** ini adalah spoofing jadi membuat method request sendiri
- **$routes->get('/komik/(:any)', 'Komik::detail/$1');** akes komik/apapun, akan di arahkan ke controller komik methodnya detail lalu untuk menyimpan nilai :any menggunakan placeholder **$1**
- pastikan code diatas dioff kan dulu
- tambahkan baris kode berikut
```php
use App\Controllers\Pages_tutor;
$routes->get('pages', [Pages_tutor::class, 'index']);
$routes->get('(:segment)', [Pages_tutor::class, 'view']);
```
- Di sini, aturan kedua dalam objek cocok dengan permintaan GET ke jalur URI /pages, dan memetakkannya ke metode dari kelas $routes->index() Pages.
- Aturan ketiga dalam objek cocok dengan permintaan GET ke segmen URI menggunakan placeholder {segment}, dan meneruskan parameter ke metode dari kelas $routes->view() Pages.
### Let’s Make our First Controller
#### Create Pages Controller
- buat file **app/Controllers/Pages_tutor.php**
- lalu ikuti baris code ini
```php
<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        // ...
    }
}
```
#### Create Views
- buat file header  **app/Views/template/header.php** 
- header 
```html
<!doctype html>
<html>

<head>
    <title>CodeIgniter Tutorial</title>
</head>

<body>

    <h1><?= esc($title) ?></h1>
```
- dan footer  **app/Views/templates/footer.php**
-footer
```html
<em>&copy; 2022</em>
</body>
</html>
```
#### Create home.php and about.php
- home dan about bisa diisi bebas bisa langusung <h1>Hello World</h1> karena sudah ada tempelate header dan footernya
#### Complete Pages::view() Method
membuat sebuah logika pada controller
```PHP
public function view($page = 'home')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('template/header', $data)
            . view('pages/' . $page)
            . view('template/footer');
    }
```
Jika halaman yang diminta tidak ditemukan, maka pengecualian PageNotFoundException akan dilemparkan.
- Pertama, fungsi ini memeriksa apakah ada file dengan nama yang diberikan dalam direktori APPPATH . 'Views/pages/'.
- Jika tidak ada file yang sesuai, maka dilemparkan sebuah pengecualian PageNotFoundException dengan parameter $page.
- Jika file ditemukan, maka variabel $data['title'] diinisialisasi dengan nilai yang diubah menjadi huruf kapital dari parameter $page.
- Kemudian, fungsi view dipanggil tiga kali untuk menampilkan tiga bagian dari halaman: header, konten halaman, dan footer.
- Fungsi view menerima dua parameter: nama file view dan data yang akan dipassing ke dalam view tersebut. Pada bagian header, data yang dipassing adalah data judul ($data['title']) yang telah diinisialisasi sebelumnya.
- Konten halaman dipassing dengan nama file yang sesuai dengan nilai $page yang diterima fungsi view.
#### Running the App
jalankan programnya dengan melakukan perintah 
```bash
php spark serve
```
pastikan dijalankan di root directory ci kalian. 
Kunjungi  localhost:8080/home. 







## Building Responses
### Views
Views  adalah file-file PHP yang mengandung markup HTML dan beberapa logika PHP untuk menampilkan data yang telah diproses oleh controller.
#### Membuat Views
- buat file **coba_view.php** pada folder **app/Views**
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coba CodeIgniter</title>
</head>
<body>
    <h1>Hello World, Coba CodeIgniter</h1>
</body>
</html>
```
- lalu save.
#### Menampilkan Views
- buat sebuah file controller **Coba.php** pada folder **app/Controller**
- lalu buat **class Coba** (sesuaikan dengan nama file) dan **method index** 
```PHP
<?php

namespace App\Controllers;

class Coba extends BaseController
{
  
    public function index()
    {
        return view('coba_view');
    }
}
```
- pada method **index** arti dari **return view('coba_view');** adalah
- method **index** akan mengembalikan sebuah view pada file **coba_view** di didalam folder **view**
- lalu pergi ke file **routes.php** pada direktori **app/Config**
- buat sebuah routes baru
```PHP
$routes->get('coba', 'Coba::index');
```
- **$routes->** codeigniter akan membuat jalur ketika ada akses
- **get** metode requestnya get (ketika kita mengetikan sesuatu di url)
- **'coba'** alamat yang diketik adalah **coba**
- **'Coba::index'** routes ini akan mengarahkan ke controller **Coba** methodnya **index**
#### Menampilkan beberapa view
- buat sebuah folder layout dan buat file header dan footer pada direktori Views
- header
```html
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Ci4</title>
  </head>
  <body>
    <h1>Header</h1>
```
- footer
```html
<p> ini bagian footer </p>
</body>
</html>
```
- pada bagian view **coba_view** hanya mengisikan isinya saja
```html
<h1>Hello World, Coba CodeIgniter</h1>
```
- muat view Layout header dan footer pada controller
```PHP
 echo view("layout/header");
 echo view("coba_view");
 echo view("layout/footer");
```
## View Layout
Layouts adalah satu-satunya file tampilan yang akan menggunakan metode **renderSection()**. Metode ini bertindak sebagai placeholder untuk konten.
### membuat layout
- buat sebuah folder **layout** dan buat file **template.php** yang berisikan sebuah header dan footer
- pada bagian tengah antara header dan footer gunakan method
```PHP
<!-- dibagian sini akan mencetak section
     yang akan kita ambil dari halaman
     yang memanggil template ini -->
    <?php $this->renderSection('content'); ?>
```
#### menggunakan layout pada view
- kita gunakan file **coba_view.php**
```HTML
<?php $this->extend('layout/template');  ?>
<?php $this->section('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coba CodeIgniter</title>
</head>
<body>
    <h1>Hello World, Coba CodeIgniter</h1>
    <?php $this->Endsection(); ?>
</body>
</html>
```
- **<?php $this->extend('layout/template');  ?>** Baris ini menginstruksikan view untuk memperluas atau mewarisi layout dari file 'layout/template'. 
- **<?php $this->section('content'); ?>**  Baris ini memulai sebuah bagian (section) bernama 'content'. Semua konten yang berada di antara baris ini dan baris $this->Endsection(); akan dimasukkan ke dalam bagian 'content' ini.
- **<?php $this->Endsection(); ?>** Baris ini menandai akhir dari bagian 'content' yang telah dimulai sebelumnya. Ini menandakan bahwa semua konten yang dimasukkan setelah baris ini akan berada di luar dari bagian 'content'.
