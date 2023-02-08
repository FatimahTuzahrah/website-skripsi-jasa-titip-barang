<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h4><?= $title ?></h4>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($trans as $jakarta => $transaksi) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $transaksi->nama ?></td>
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
                    <a href="" class=" btn btn-sm btn-warning">Kirim</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>

</table>
<?= $this->endSection() ?>