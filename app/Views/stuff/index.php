 <?= $this->extend('layout') ?>
 <?= $this->section('content') ?>
 <?php
    // $keyword = [
    //     'name' => 'keyword',
    //     'value' => $keyword,
    //     'placeholder' => 'Search'
    // ];
    // $submit = [
    //     'name' => 'submit',
    //     'id' => 'submit',
    //     'value' => 'Submit',
    //     'class' => 'btn btn-success',
    //     'type' => 'submit'
    // ];
    // 
    ?>
 <h1>Barang</h1>

 <table class="table">
     <thead>
         <th>No</th>
         <th>Barang</th>
         <th>Gambar</th>
         <th>Harga</th>
         <th>Aksi</th>
     </thead>
     <tbody>
         <?php foreach ($stuffs as $index => $stuff) : ?>
             <tr>
                 <td><?= ($index + 1) ?></td>
                 <td><?= $stuff->nama ?></td>
                 <td>
                     <img class="img-fluid" width="200px" alt="gambar" src="<?= base_url('uploads/' . $stuff->gambar) ?>">
                 </td>
                 <td><?= $stuff->harga ?></td>
                 <td>
                     <a href="<?= site_url('stuff/view/' . $stuff->id) ?>" class="btn btn-primary">View</a>
                     <a href="<?= site_url('stuff/update/' . $stuff->id) ?>" class="btn btn-success">Update</a>
                 </td>
             </tr>

         <?php endforeach ?>
     </tbody>
 </table>
 <?= $this->endSection() ?>