<?= $this->extend('layouts/main') ?><?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h3">Inventaris Aset / KIB</h1><div><a class="btn btn-outline-secondary" href="<?= site_url('aset/kir/1') ?>">Contoh KIR Gudang</a> <a class="btn btn-primary" href="<?= site_url('aset/inventaris/create') ?>">Tambah Aset</a></div></div>
<?php if ($message = session('success')): ?><div class="alert alert-success"><?= esc($message) ?></div><?php endif ?>
<div class="card shadow-sm"><div class="card-body p-0"><table class="table table-hover mb-0"><thead><tr><th>Registrasi</th><th>Nama Aset</th><th>KIB</th><th>Ruangan</th><th>Penanggung Jawab</th><th>Tahun</th><th>Kondisi</th></tr></thead><tbody>
<?php foreach ($aset as $row): ?><tr><td><?= esc($row['nomor_registrasi']) ?></td><td><?= esc($row['nama_aset']) ?></td><td>KIB <?= esc($row['kategori_kib']) ?></td><td><?= esc($row['ruangan_nama']) ?></td><td><?= esc($row['penanggung_jawab'] ?? 'Belum ditentukan') ?></td><td><?= esc($row['tahun_perolehan']) ?></td><td><?= esc($row['kondisi']) ?></td></tr><?php endforeach ?>
</tbody></table></div></div><?= $this->endSection() ?>
