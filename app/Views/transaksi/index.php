<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>Transaksi</h3>
<div class="row">
    <div class="col-md-4">
        <form action="<?= base_url('transaksi'); ?>" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" name="keyword" autocomplete="off" autofocus>
                <div class="input-group-append">
                    <input class="btn btn-success" type="submit" name="submit">
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Gambar Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($model as $index => $transaksi) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td>
                    <img class="img-fluid" width="200px" alt="gambar" src="<?= base_url('uploads/' . $stuff->gambar) ?>">
                </td>
                <td><?= $transaksi->jumlah ?></td>
                <td><?= "Rp " . number_format($transaksi->total_harga, 2, ',', '.') ?></td>
                <td><?php if ($transaksi->status == 0) {
                        echo "Belum di Proses";
                    } else if ($transaksi->status == 1) {
                        echo "Dikirim";
                    } else if ($transaksi->status == 2) {
                        echo "Diterima";
                    } ?></td>
                <td>
                    <a href="<?= site_url('transaksi/view/' . $transaksi->id) ?>" class="btn btn-sm btn-primary">Lihat Detail</a>
                    <a href="<?= site_url('transaksi/invoice/' . $transaksi->id) ?>" class="btn btn-sm btn-info">Selesai</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>
<?= $this->endSection() ?>