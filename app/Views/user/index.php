<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>JASTIP</h1>
<table class="table">
    <thead>
        <th>ID</th>
        <th>User Name</th>
        <th>Created By</th>
        <th>Created Date</th>
    </thead>
    <tbody>
        <?php foreach ($data as $index => $user) : ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->created_by ?></td>
                <td><?= $user->created_date ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection() ?>