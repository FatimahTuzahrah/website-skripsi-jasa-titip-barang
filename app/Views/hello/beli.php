<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
$id_stuff = [
    'name' => 'id_stuff',
    'id' => 'id_stuff',
    'value' => $model->id,
    'type' => 'hidden'
];
$id_user = [
    'name' => 'id_user',
    'id' => 'id_user',
    'value' => $model->id,
    'type' => 'hidden'
];
$jumlah = [
    'name' => 'jumlah',
    'id' => 'jumlah',
    'value' => 1,
    'min' => 1,
    'class' => 'form-control',
    'type' => 'number',
    'max' => $model->stok,
    'onkeydown' => 'return false',
];
$total_harga = [
    'name' => 'total_harga',
    'id' => 'total_harga',
    'value' => null,
    'class' => 'form-control',
    'readonly' => true,
];
$ongkir = [
    'name' => 'ongkir',
    'id' => 'ongkir',
    'value' => null,
    'class' => 'form-control',
    'readonly' => true,
];
$alamat = [
    'name' => 'alamat',
    'id' => 'alamat',
    'class' => 'form-control',
    'value' => $user->alamat,
];
$submit = [
    'name' => 'submit',
    'id' => 'submit',
    'type' => 'submit',
    'value' => 'Beli',
    'class' => 'btn btn-success',
];
?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card-body">
                <img class="img-fluid" src="<?= base_url('uploads/' . $model->gambar) ?>">
                <h1 class="text-success"><?= $model->nama ?></h1>
                <h4> Harga : <?= $model->harga ?></h4>
                <h4> Nama Jastip : <?= $model->nama_jastip ?></h4>
            </div>
        </div>
        <div class="col-6">
            <h2>Pengiriman</h2>
            <div class="form-group">
                <label for="provinsi">Pilih provinsi</label>
                <select class="form-control" id="provinsi">
                    <option>Select Provinsi</option>
                    <?php foreach ($provinsi as $p) : ?>
                        <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                    <?php endforeach ?>
                </select>
                <div class="form-group">
                    <label for="kabupaten">Pilih Kabupaten/Kota</label>
                    <select class="form-control" id="kabupaten">
                        <option>Select Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="service">Pilih Service</label>
                    <select class="form-control" id="service">
                        <option>Select Service</option>
                    </select>
                </div>

                <strong>Estimasi : <span id="estimasi"></span></strong>
                <hr>

                <?= form_input($id_stuff) ?>
                <?= form_input($id_user) ?>
                <div class="form-group">
                    <?= form_label('Jumlah Pembelian', 'jumlah') ?>
                    <?= form_input($jumlah) ?>
                </div>
                <div class="form-group">
                    <?= form_label('Ongkir', 'ongkir') ?>
                    <?= form_input($ongkir) ?>
                </div>
                <div class="form-group">
                    <?= form_label('Total Harga', 'total_harga') ?>
                    <?= form_input($total_harga) ?>
                </div>
                <div class="form-group">
                    <?= form_label('Alamat', 'alamat') ?>
                    <?= form_input($alamat, $user->alamat) ?>
                </div>
                <div class="text-right">
                    <button id="pay-button" class="btn btn-success" onclick="token();">Beli</button>
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Komentar</h4>
                            </div>
                            <div class="col-md-6" text-right>
                                <a href="<?= site_url('komentar/create/' . $model->id) ?>" class="btn btn-link">Tinggalkan Komentar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php foreach ($komentar as $k) : ?>
                                    <?php
                                    $modelUser = new \App\Models\UserModel();
                                    $namaUser = $modelUser->find($k->id_user)->username;
                                    ?>
                                    <strong><?= $namaUser ?></strong>
                                    <br>
                                    <?= $k->komentar ?>
                                    <hr>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

    <form id="pay" action="<?= site_url("home/simpanTransaksi") ?>" method="POST">
        <input type="hidden" id="harga" name="harga" />
        <input type="hidden" id="kurir" name="kurir" />
        <input type="hidden" id="firstname" name="firstname" />
        <input type="hidden" id="lastname" name="lastname" />
        <input type="hidden" id="nophone" name="nophone" />
        <input type="hidden" id="address" name="alamat" />
        <input type="hidden" id="postalcode" name="postalcode" />
        <input type="hidden" id="city" name="city" />
        <input type="hidden" id="namabarang" name="namabarang" />
        <input type="hidden" id="orderid" name="orderid" />
        <input type="hidden" id="transactiontime" name="transactiontime" />
        <input type="hidden" id="transactionstatus" name="transactionstatus" />
        <input type="hidden" id="jumlahBarang" name="jumlahBarang" />
        <input type="hidden" id="ongkirBarang" name="ongkirBarang" />
        <input type="hidden" id="id_stuff_barang" name="id_stuff_barang" />


    </form>
    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script>
        var totalHargaTemp = 0;
        var jsonSelect = "";
        var serviceSelect = "";
        $('document').ready(function() {
            var jumlah_pembelian = document.getElementById('jumlah').value;
            var harga = <?= $model->harga ?>;
            var ongkir = 0;
            $("#provinsi").on('change', function() {
                $("#kabupaten").empty();
                var id_province = $(this).val();
                $.ajax({
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    url: "<?= site_url('hello') ?>",
                    type: 'GET',
                    data: {
                        'id_province': id_province,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var results = data["rajaongkir"]["results"];
                        for (var i = 0; i < results.length; i++) {
                            var json = new Object();
                            json.nama = results[i]['city_name'];
                            json.id = results[i]["city_id"];
                            json.postal_code = results[i]["postal_code"];
                            var jsonString = JSON.stringify(json);
                            $("#kabupaten").append($('<option>', {
                                value: jsonString,
                                text: results[i]['city_name'],
                            }));
                        }
                    }
                });
            });
            $("#kabupaten").on('change', function() {
                var obj = JSON.parse($(this).val());
                jsonSelect = obj;
                var id_city = obj.id;
                $.ajax({
                    url: "<?= site_url('helloCost') ?>",
                    type: 'GET',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    data: {
                        'origin': <?= $user->origin ?>,
                        'destination': id_city,
                        'weight': 1000,
                        'courier': 'jne:pos:tiki'
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var results = data["rajaongkir"]["results"][0]["costs"];
                        for (var i = 0; i < results.length; i++) {
                            var text = results[i]["description"] + "(" + results[i]["service"] + ")";

                            $("#service").append($('<option>', {
                                value: results[i]["cost"][0]["value"],
                                text: text,
                                etd: results[i]["cost"][0]["etd"],
                            }));
                        }
                    }
                });
            });

            $("#service").on('change', function() {
                serviceSelect = "test";
                var estimasi = $('option:selected', this).attr('etd');
                ongkir = parseInt($(this).val());
                $("#ongkir").val(ongkir);
                $("#estimasi").html(estimasi + " Hari");
                var total_harga = (jumlah_pembelian * harga) + ongkir;
                totalHargaTemp = total_harga;
                $("#total_harga").val(total_harga);
            });
            $("#jumlah").on("change", function() {
                jumlah_pembelian = $("#jumlah").val();
                var total_harga = (jumlah_pembelian * harga) + ongkir;
                totalHargaTemp = total_harga;
                $("#total_harga").val(total_harga);
            });
        });
    </script>
    <?= $this->endSection() ?>


    <?= $this->section('script') ?>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-CpJJEwhrYmnlBDpo"></script>
    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script type="text/javascript">
        function token() {
            // console.log("Harga : " + totalHargaTemp);
            var select = document.getElementById('service');
            console.log("Test : " + select.options[select.selectedIndex].text);
            var serviceTerkirim = select.options[select.selectedIndex].text.toString();
            document.getElementById("kurir").value = "" + serviceTerkirim;
            // document.getElementById("namaService").value = serviceTerkirim;
            $.ajax({
                type: 'POST',
                data: {
                    ajax: true,
                    harga: totalHargaTemp,
                    firstname: "<?= $user->firstname ?>",
                    lastname: "<?= $user->lastname ?>",
                    nophone: "<?= $user->no_telfon ?>",
                    address: "<?= $user->alamat ?>",
                    postalcode: jsonSelect.postal_code,
                    city: jsonSelect.nama,
                    namabarang: "<?= $model->nama ?>",
                },
                url: '<?= site_url("home/getSnaptoken") ?>',
                success: function(data) {
                    snap.pay(data, {
                        // Optional
                        onSuccess: function(result) {
                            /* You may add your own js here, this is just example  simpan db*/
                            console.log(JSON.stringify(result, null, 2));
                            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            let dataResult = JSON.stringify(result, null, 2);
                            let dataObj = JSON.parse(dataResult);
                            var jumlahBarang = document.getElementById('jumlah').value;

                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            document.getElementById("harga").value = document.getElementById('total_harga').value;
                            document.getElementById("firstname").value = "<?= $user->firstname ?>";
                            document.getElementById("lastname").value = "<?= $user->lastname ?>";
                            document.getElementById("nophone").value = "<?= $user->no_telfon ?>";
                            document.getElementById("address").value = "<?= $user->alamat ?>";
                            document.getElementById("postalcode").value = jsonSelect.postal_code;
                            document.getElementById("city").value = jsonSelect.nama;
                            document.getElementById("namabarang").value = "<?= $model->nama ?>";
                            document.getElementById("orderid").value = dataObj.order_id;
                            document.getElementById("jumlahBarang").value = jumlahBarang;
                            document.getElementById("ongkirBarang").value = document.getElementById('ongkir').value;
                            document.getElementById("transactiontime").value = dataObj.transaction_time;
                            document.getElementById("transactionstatus").value = dataObj.transaction_status;
                            document.getElementById("id_stuff_barang").value = <?= $model->id ?>;


                            document.getElementById('pay').submit();
                        },
                        // Optional
                        onPending: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);

                        },
                        // Optional
                        onError: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                }
            });

        }
    </script>
    <?= $this->endSection() ?>