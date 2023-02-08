<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Cek Resi</h1>
<div class="row">
    <div class="col-xl-5">
        <input type="text" class="form-control" placeholder="Masukkan no resi" v-model="Data.Resi.awb">
    </div>
    <div class="col-xl-5">
        <select class="form-control" v-model="Data.Resi.courier">
            <option value="">Pilih Ekspedisi</option>
            <option>Select Service</option>
        </select>
    </div>
    <div class="col-xl-2">
        <button type="button" class="btn btn-primary_cek-resi" @click="CekResi()">
            <span>Cari</span>
        </button>
    </div>
</div>

<?= $this->endSection() ?>