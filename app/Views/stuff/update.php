<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php

$nama = [
    'name' => 'nama',
    'id' => 'nama',
    'value' => $stuff->nama,
    'class' => 'form-control',
];

$harga = [
    'name' => 'harga',
    'id' => 'harga',
    'value' => $stuff->harga,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];

$nama_jastip = [
    'name' => 'nama_jastip',
    'id' => 'nama_jastip',
    'value' => $stuff->nama_jastip,
    'class' => 'form-control',
];

$gambar = [
    'name' => 'gambar',
    'id' => 'gambar',
    'value' => null,
    'class' => 'form-control',
];

$submit = [
    'name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-success',
    'type' => 'submit'
];

?>
<h1>Update Barang</h1>

<?= form_open_multipart('Stuff/update/' . $stuff->id) ?>
<div class="form-group">
    <?= form_label("Nama", "nama") ?>
    <?= form_input($nama) ?>
</div>

<div class="form-group">
    <?= form_label("Harga", "harga") ?>
    <?= form_input($harga) ?>
</div>

<div class="form-group">
    <?= form_label("Nama Jastip", "nama_jastip") ?>
    <?= form_input($nama_jastip) ?>
</div>

<img class="img-fluid" alt="image" src="<?= base_url('uploads/' . $stuff->gambar) ?>">

<div class="form-group">
    <?= form_label("Gambar Barang", "gambar") ?>
    <?= form_upload($gambar) ?>
</div>

<div class="text-right">
    <?= form_submit($submit) ?>
</div>

<?= form_close() ?>
<?= $this->endSection() ?>