<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h4>Pembayaran</h4>
<tr>
    <p>Silahkan Melakukan Pembayaran Melalui Nomer Rekening Di Bawah Ini: </p>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">INDOMART</li>
        <li class="list-group-item">ALFAMART</li>
        <li class="list-group-item">BANK MANDIRI</li>
        <li class="list-group-item">BANK BNI</li>
        <li class="list-group-item">BANK BCA</li>
    </ul>
</tr>

<?php
if (empty($tr->bukti_pembayaran)) {
?>
    <button type="button" class="btn btn-sm btn-danger mt-3" data-toggle="modal" data-target="#exampleModal">
        Upload Bukti Pembayaran
    </button>
<?php } elseif ($tr->status == '0') { ?>
    <button style="width: 100%" class="btn btn-sm btn-warning"><i class="fa fa clock-o"></i>Mengunngu Konfirmasi</button>
<?php } elseif ($tr->status == '1') { ?>
    <button class="btn btn-sm btn-success"><i class="fa fa check"></i>Pembayaran Selesai</button>
<?php } ?>

<!--Modal Untuk uplaod bukti pemabayaran -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('transaksi/') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload Bukti Pembayaran</label>
                        <input type="hidden" name="" class="form-control" value="">
                        <input type="file" name="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>