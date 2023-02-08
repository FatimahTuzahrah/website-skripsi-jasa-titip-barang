<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'value' => null,
    'class' => 'form-control'
];
$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control'
];
$repeatPassword = [
    'name' => 'repeatPassword',
    'id' => 'repeatPassword',
    'class' => 'form-control'
];
$email = [
    'name' => 'email',
    'id' => 'email',
    'value' => null,
    'class' => 'form-control'
];
$alamat_jastip = [
    'name' => 'alamat_jastip',
    'id' => 'alamat_jastip',
    'value' => null,
    'class' => 'form-control'
];
$no_telfon = [
    'name' => 'no_telfon',
    'id' => 'no_telfon',
    'class' => 'form-control',
    'type' => 'number',
    'min' => 0,
];
$role = [
    'name' => 'role',
    'id' => 'role',
    'value' => null,
    'class' => 'form-control',
];
$firstname = [
    'name' => 'firstname',
    'id' => 'firstname',
    'value' => null,
    'class' => 'form-control',
];
$lastname = [
    'name' => 'lastname',
    'id' => 'lastname',
    'value' => null,
    'class' => 'form-control',
];
$peran = [
    'name' => 'peran',
    'id' => 'peran',
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
$session = session();
$errors = $session->getFlashdata('errors');
?>
<h1>Register Form</h1>

<?php if ($errors != null) : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Terjadi Kesalahan</h4>
        <hr>
        <p class="mb-0">
            <?php
            foreach ($errors as $err) {
                echo $err . '<br>';
            }
            ?>
        </p>
    </div>

    <?php if ($user->provinsi) {
    } else if ($user->kota) {
    } else if ($user->alamat) {
    } ?>

<?php endif ?>
<div class="col-6">
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

        <?= form_open('Auth/register') ?>
        <div class="form-group">
            <?= form_label("Username", "username") ?>
            <?= form_input($username) ?>
        </div>
        <div class="form-group">
            <?= form_label("Password", "password") ?>
            <?= form_password($password) ?>
        </div>
        <div class="form-group">
            <?= form_label("Repeat Password", "repeatpassword") ?>
            <?= form_password($repeatPassword) ?>
        </div>
        <div class="form-group">
            <?= form_label("Email", "email") ?>
            <?= form_input($email) ?>
        </div>
        <div class="form-group">
            <?= form_label("Alamat Jastip", "alamat_jastip") ?>
            <?= form_input($alamat_jastip) ?>
        </div>
        <div class="form-group">
            <?= form_label("Nomer Telfon", "no_telfon") ?>
            <?= form_input($no_telfon) ?>
        </div>
        <div class="form-group">
            <?= form_label("Nama Depan", "firstname") ?>
            <?= form_input($firstname) ?>
        </div>
        <div class="form-group">
            <?= form_label("Nama Belakang", "lastname") ?>
            <?= form_input($lastname) ?>
        </div>
        <div class="form-group">
            <?= form_label("Masuk Sebagai", "peran") ?>
            <br>
            <i>Contoh: pemiliki jastip atau pembeli</i>
            <?= form_input($peran) ?>
        </div>
        <div class="text-right">
            <?= form_submit('submit', 'Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= form_close() ?>
    </div>
    <?= $this->endSection() ?>
    <?= $this->section('script') ?>
    <script>
        $('document').ready(function() {
            $("#provinsi").on('change', function() {
                $("#kabupaten").empty();
                var id_province = $(this).val();
                $.ajax({
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    url: "<?= site_url('auth/getCity') ?>",
                    type: 'GET',
                    data: {
                        'id_province': id_province,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var results = data["rajaongkir"]["results"];
                        for (var i = 0; i < results.length; i++) {
                            // var json = new Object();
                            // json.nama = results[i]['city_name'];
                            // json.id = results[i]["city_id"];
                            // json.postal_code = results[i]["postal_code"];
                            // var jsonString = JSON.stringify(json);
                            $("#kabupaten").append($('<option>', {
                                value: results[i]['city_id'],
                                text: results[i]['city_name'],
                            }));
                        }
                    }
                });
            });
        });
    </script>
    <?= $this->endSection() ?>