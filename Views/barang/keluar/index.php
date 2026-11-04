<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h3">Pengeluaran Barang</h1><a class="btn btn-primary" href="<?= site_url('barang/keluar/create') ?>">Tambah</a></div>
<?php if ($message = session('success')): ?><div class="alert alert-success"><?= esc($message) ?></div><?php endif ?>
<?php if ($message = session('error')): ?><div class="alert alert-danger"><?= esc($message) ?></div><?php endif ?>
<div class="card shadow-sm"><div class="card-body p-0"><table class="table table-hover mb-0"><thead><tr><th>No. Bukti</th><th>Tanggal</th><th>Ruangan</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach ($transaksi as $row): ?><tr><td><?= esc($row['nomor_bukti']) ?></td><td><?= esc($row['tanggal']) ?></td><td><?= esc($row['nama_ruangan']) ?></td><td><span class="badge text-bg-success"><?= esc($row['status']) ?></span></td><td>-</td></tr><?php endforeach ?>
</tbody></table></div></div>
<?= $this->endSection() ?>
