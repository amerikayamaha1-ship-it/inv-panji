<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="h3 mb-3">Pengajuan Pengeluaran Barang</h1>
<?php if ($error = session('error')): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif ?>
<form method="post" action="<?= site_url('barang/keluar') ?>">
<?= csrf_field() ?>
<div class="row g-3 mb-3">
    <div class="col-md-4"><label class="form-label">Tanggal</label><input type="date" name="tanggal" class="form-control" value="<?= old('tanggal', date('Y-m-d')) ?>" required></div>
    <div class="col-md-4"><label class="form-label">Ruangan/Unit</label><select name="ruangan_id" class="form-select" required><option value="">Pilih ruangan</option><?php foreach ($ruangan as $row): ?><option value="<?= esc($row['id']) ?>"><?= esc($row['nama']) ?></option><?php endforeach ?></select></div>
</div>
<div class="card mb-3"><div class="card-body"><div class="mb-3"><?php include APPPATH . 'Views/components/barcode-tools.php'; ?></div><table class="table" id="detailTable"><thead><tr><th>Barang</th><th width="150">Jumlah</th><th width="160">Harga</th><th></th></tr></thead><tbody><tr>
<td><select name="items[0][barang_id]" class="form-select barang-select" required><option value="">Pilih barang</option><?php foreach ($barang as $row): ?><option value="<?= esc($row['id']) ?>" data-barcode="<?= esc($row['kode_barang']) ?>"><?= esc($row['nama_barang']) ?> (<?= esc($row['kode_barang']) ?>, stok <?= esc($row['stok']) ?>)</option><?php endforeach ?></select></td>
<td><input type="number" step="0.01" min="0.01" name="items[0][jumlah]" class="form-control" required></td>
<td><input type="number" step="0.01" min="0" name="items[0][harga_satuan]" class="form-control" value="0"></td><td></td>
</tr></tbody></table><button type="button" class="btn btn-outline-secondary btn-sm" onclick="addRow()">+ Baris</button></div></div>
<div class="mb-3"><label class="form-label">Keterangan</label><textarea name="keterangan" class="form-control"></textarea></div>
<button class="btn btn-primary">Simpan Pengeluaran</button> <a class="btn btn-secondary" href="<?= site_url('barang/keluar') ?>">Batal</a>
</form>
<script>
let rowIndex = 1;
function addRow() {
    const row = document.querySelector('#detailTable tbody tr').cloneNode(true);
    row.querySelectorAll('input, select').forEach((el) => {
        el.name = el.name.replace(/\[\d+\]/, '[' + rowIndex + ']');
        if (el.tagName === 'INPUT') el.value = el.name.includes('harga_satuan') ? '0' : '';
        if (el.tagName === 'SELECT') el.selectedIndex = 0;
    });
    document.querySelector('#detailTable tbody').appendChild(row);
    rowIndex++;
}
</script>
<script>
const search=document.querySelector('.barang-search');
search.addEventListener('input',()=>document.querySelectorAll('.barang-select option').forEach(o=>{o.hidden=!!search.value&&!o.textContent.toLowerCase().includes(search.value.toLowerCase())}));
document.querySelector('.scan-barcode').addEventListener('click',async()=>{if(!('BarcodeDetector' in window)){alert('Browser belum mendukung scan kamera. Gunakan input kode barcode pada kotak pencarian.');return}const video=document.createElement('video');video.style='position:fixed;inset:10%;width:80%;z-index:1050;background:#000';document.body.appendChild(video);const stream=await navigator.mediaDevices.getUserMedia({video:{facingMode:'environment'}});video.srcObject=stream;await video.play();const detector=new BarcodeDetector();const timer=setInterval(async()=>{const codes=await detector.detect(video);if(codes.length){search.value=codes[0].rawValue;search.dispatchEvent(new Event('input'));const option=[...document.querySelectorAll('.barang-select option')].find(o=>o.dataset.barcode===codes[0].rawValue);if(option){option.closest('select').value=option.value}clearInterval(timer);stream.getTracks().forEach(t=>t.stop());video.remove()}},300)});
</script>
<?= $this->endSection() ?>
