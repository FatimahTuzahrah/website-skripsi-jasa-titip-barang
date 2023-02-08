<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php

$nama = [
    'name' => 'nama',
    'id' => 'nama',
    'value' => null,
    'class' => 'form-control',
];

$harga = [
    'name' => 'harga',
    'id' => 'harga',
    'value' => null,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];

$nama_jastip = [
    'name' => 'nama_jastip',
    'id' => 'nama_jastip',
    'value' => null,
    'class' => 'form-control',
];

$gambar = [
    'name' => 'gambar',
    'id' => 'gambar',
    'value' => null,
    'class' => 'form-control',
];

$alamat_jastip = [
    'name' => 'alamat_jastip',
    'id' => 'alamat_jastip',
    'value' => null,
    'class' => 'form-control',
];

$jenis_barang = [
    'name' => 'jenis_barang',
    'id' => 'jenis_barang',
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
<h1>Tambah Barang</h1>

<?= form_open_multipart('Stuff/create') ?>
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

<div class="form-group">
    <?= form_label("Gambar Barang", "gambar") ?>
    <?= form_upload($gambar) ?>
</div>

<div class="form-group">
    <?= form_label("Jenis Barang", "jenis_barang") ?>
    <?= form_input($jenis_barang) ?>
</div>

<div class="form-group">
    <?= form_label("Alamat Jastip", "alamat_jastip") ?>
    <?= form_input($alamat_jastip) ?>
</div>

<div class="text-right">
    <?= form_submit($submit) ?>
</div>

<?= form_close() ?>
<?= $this->endSection() ?>