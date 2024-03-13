<?php $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Komik</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $komik['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $komik['judul']; ?></h5>
                            <p class="card-text"><b>Penulis : </b> <?= $komik['penulis']; ?></p>
                            <p class="card-text"><small class="text-body-secondary">Penerbit : <?= $komik['penerbit']; ?></small></p>
                            <a href="" class="btn btn-warning">Edit</a>

                            <form action="/komik/<?= $komik['id']; ?>" method="post" class="d-inline">
                            <!-- csrf untuk keamanan dan terhindar dari hacking -->
                            <?= csrf_field(); ?>
                            <!-- di bagian input yang HTTP spoofing -->
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <!-- controller komik/method delete/ berdasarkan id -->
                            <div class="mt-2"><a href="/komik">Kembali ke daftar komik</a></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->Endsection(''); ?>