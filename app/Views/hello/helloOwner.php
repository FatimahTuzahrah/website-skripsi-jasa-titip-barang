<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Welcome To Jastip Maluku Utara</h1>
<h4>
    <?php
    echo session()->get('username');
    ?>
</h4>
<div class="container">
    <div class="row">
        <?php foreach ($model as $m) : ?>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header">
                        <span class="text-dark"><strong><?= $m->nama ?></strong></span>
                    </div>
                    <div class="card-body">
                        <img class="img-thumbnail" style="max-height: 200px" src="<?= base_url('uploads/' . $m->gambar) ?>">
                        <h5 class="mt-3 text-dark"><?= "Rp" . number_format($m->harga, 2, ',', '.') ?></h5>
                        <p class="text-info"> Nama Jastip: <?= $m->nama_jastip ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?= $this->endSection() ?>