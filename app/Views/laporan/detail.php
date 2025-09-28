<?php
// app/Views/laporan/detail.php
?>
<?= $this->extend('layout/frontend') ?>
<?= $this->section('content') ?>

<h2><?= esc($report['judul']) ?></h2>
<div class="text-muted small mb-3"><?= date('d M Y', strtotime($report['tanggal'])) ?></div>
<div class="mb-4"><?= auto_embed_media($report['deskripsi']) ?></div>

<?php
$gambar = array_filter($report['files'] ?? [], function($f) {
    $ext = strtolower(pathinfo($f['file'], PATHINFO_EXTENSION));
    return in_array($ext, ['jpg','jpeg','png','gif','webp']);
});
?>

<?php if (!empty($gambar)): ?>
<div id="gambarCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php foreach (array_values($gambar) as $i => $file): ?>
    <div class="carousel-item<?= $i == 0 ? ' active' : '' ?>">
      <img src="<?= base_url('uploads/docs/'.$file['file']) ?>" class="d-block w-100 rounded" style="max-height:480px;object-fit:contain;" alt="<?= esc($file['label'] ?: $file['file']) ?>">
      <div class="carousel-caption d-none d-md-block">
        <small><?= esc($file['label'] ?: $file['file']) ?></small>
      </div>
    </div>
    <?php endforeach ?>
  </div>
  <?php if (count($gambar) > 1): ?>
  <button class="carousel-control-prev" type="button" data-bs-target="#gambarCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#gambarCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
  <?php endif ?>
</div>
<?php endif ?>

<h5>Daftar File Laporan:</h5>
<ul>
<?php foreach ($report['files'] as $file): ?>
    <?php
    $ext = strtolower(pathinfo($file['file'], PATHINFO_EXTENSION));
    $fileUrl = base_url('uploads/docs/'.$file['file']);
    ?>
    <li class="mb-3">
        <?php if (in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
            <!-- Sudah ditampilkan di carousel -->
        <?php elseif ($ext === 'pdf'): ?>
            <div class="ratio ratio-16x9 mb-2">
                <iframe src="<?= $fileUrl ?>#toolbar=1" style="width:100%;height:100%;border:0;"></iframe>
            </div>
            <a href="<?= $fileUrl ?>" class="btn btn-outline-secondary btn-sm" target="_blank"><i class="bi bi-file-earmark-pdf"></i> Download PDF</a>
        <?php elseif (in_array($ext, ['mp3','wav','ogg'])): ?>
            <audio controls class="mt-2"><source src="<?= $fileUrl ?>"></audio>
        <?php elseif (in_array($ext, ['doc','docx','xls','xlsx'])): ?>
            <div class="ratio ratio-16x9 mb-2">
                <iframe src="https://docs.google.com/gview?url=<?= urlencode($fileUrl) ?>&embedded=true" style="width:100%;height:100%;" frameborder="0"></iframe>
            </div>
            <a href="<?= $fileUrl ?>" class="btn btn-outline-secondary btn-sm" target="_blank"><i class="bi bi-download"></i> Download File</a>
        <?php else: ?>
            <a href="<?= $fileUrl ?>" target="_blank" class="btn btn-outline-secondary btn-sm">Download File</a>
        <?php endif ?>
        <?php if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
            <div><?= esc($file['label'] ?: $file['file']) ?></div>
        <?php endif ?>
    </li>
<?php endforeach ?>
</ul>

<a href="<?= site_url('laporan') ?>" class="btn btn-link mt-4"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Laporan</a>

<?= $this->endSection() ?>