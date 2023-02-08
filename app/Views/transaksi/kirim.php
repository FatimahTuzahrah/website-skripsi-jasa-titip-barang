<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php

$id_stuff = [
    'name' => 'id_stuff',
    'id' => 'id_stuff',
    'value' => $model,
    'type' => 'hidden'
];

$skenario = [
    'name' => 'kenario',
    'id' => 'skenario',
    'value' => null,
    'class' => 'form-control',
    'min' => 0,
];

$banyak_gen = [
    'name' => 'banyak_gen',
    'id' => 'banyak_gen',
    'value' => null,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];

$maksimal_generasi = [
    'name' => 'maksimal_generasi',
    'id' => 'maksimal_generasi',
    'value' => null,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];

$crossover_rate = [
    'name' => 'crossover_rate',
    'id' => 'crossover_rate',
    'value' => null,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];

$mutasi_rate = [
    'name' => 'mutasi_rate',
    'id' => 'mutasi_rate',
    'value' => null,
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];

$submit = [
    'name' => 'submit',
    'id' => 'submit',
    'value' => 'Submit',
    'class' => 'btn btn-success',
    'type' => 'submit'
];

?>
<h3>Pengiriman</h3>

<?= form_open_multipart('Transaksi/Kirim') ?>
<div class="form-group">
    <?= form_label("Skenario", "skenario") ?>
    <?= form_input($skenario) ?>
</div>

<div class="form-group">
    <?= form_label("Banyak Gen", "banyak_gen") ?>
    <?= form_input($banyak_gen) ?>
</div>

<div class="form-group">
    <?= form_label("Maksimal Generasi", "maksimal_generasi") ?>
    <?= form_input($maksimal_generasi) ?>
</div>

<div class="form-group">
    <?= form_label("Crossover Rate", "crossover_rate") ?>
    <?= form_input($crossover_rate) ?>
</div>

<div class="form-group">
    <?= form_label("Mutasi Rate", "mutasi_rate") ?>
    <?= form_input($mutasi_rate) ?>
</div>

<div class="text-right">
    <?= form_submit($submit) ?>
</div>

<?= form_close() ?>


<?= $this->endSection() ?>