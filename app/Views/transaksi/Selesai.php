<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>Pengiriman Barang</h3>
<h4>Barang yang akan di kirim terlebih dahulu: <a href="staff/view">Pengiriman</a></h4>
<?php foreach ($gambar as $g) : ?>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('uploads/' . $g->gambar) ?>" style="width:200px;" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $g->nama_barang ?></h5>
                    <p class="card-text"><?= $g->deskripsi ?></p>
                    <a href=<?= site_url('transaksi/print') ?> class="btn btn-info" onclick="return confirm('apakah barang sudah sampai?')">Selesai</a>
                    <script src="dist/sweetalert2.all.min.js"></script>
                </div>
            </div>
            <td>

            </td>
        </div>

    </div>
<?php endforeach ?>

<?= $this->endSection() ?>