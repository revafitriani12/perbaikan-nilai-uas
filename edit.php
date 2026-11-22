<?php
$prodi  = $mk['ProgramStudi'];
$status = $mk['Status'];
$daftarProdi = ['D3 Komputerisasi Akuntansi', 'S1 Sistem Informasi', 'S1 Rekayasa Perangkat Lunak'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Mata Kuliah</title>
<style>
  body{font-family:Arial,sans-serif;background:#f4f6f9;color:#222}
  .box{max-width:520px;margin:30px auto;background:#fff;padding:24px;border-radius:8px}
  label{display:block;margin-top:14px;font-weight:bold;font-size:14px}
  .form-control{width:100%;padding:8px;margin-top:5px;box-sizing:border-box;border:1px solid #cbd5e1;border-radius:6px}
  .radio-group label{display:inline;font-weight:normal;margin-right:14px}
  .btn{padding:8px 16px;border:0;border-radius:6px;color:#fff;background:#d97706;cursor:pointer;text-decoration:none;font-size:14px}
  .btn-batal{background:#6b7280}
  .error{background:#fee2e2;padding:10px;border-radius:6px;margin-bottom:10px}
</style>
</head>
<body>
<div class="box">
  <h2>Edit Mata Kuliah</h2>
  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
  <?php endif; ?>

  <form method="POST" action="index.php?action=edit">
    <input type="hidden" name="id" value="<?= (int)$mk['IdMataKuliah'] ?>">

    <label>Kode Mata Kuliah:</label>
    <input type="text" name="kode" class="form-control" placeholder="Kode..." maxlength="20" required
           value="<?= htmlspecialchars($mk['KodeMataKuliah'], ENT_QUOTES, 'UTF-8') ?>">

    <label>Nama Mata Kuliah:</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama..." maxlength="100" required
           value="<?= htmlspecialchars($mk['NamaMataKuliah'], ENT_QUOTES, 'UTF-8') ?>">

    <label>Program Studi:</label>
    <select name="prodi" required class="form-control">
      <option value="">-- Pilih Program Studi --</option>
      <?php foreach ($daftarProdi as $p): ?>
        <option value="<?= htmlspecialchars($p, ENT_QUOTES, 'UTF-8') ?>" <?= ($prodi == $p) ? 'selected' : '' ?>>
          <?= htmlspecialchars($p, ENT_QUOTES, 'UTF-8') ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label>Semester (1-8):</label>
    <input type="number" name="smt" class="form-control" min="1" max="8" required
           value="<?= htmlspecialchars($mk['Semester'], ENT_QUOTES, 'UTF-8') ?>">

    <label>SKS (1-6):</label>
    <input type="number" name="sks" class="form-control" min="1" max="6" required
           value="<?= htmlspecialchars($mk['SKS'], ENT_QUOTES, 'UTF-8') ?>">

    <label>Status Mata Kuliah:</label>
    <div class="radio-group">
      <input type="radio" id="aktif" name="status" value="Aktif" <?= ($status == 'Aktif') ? 'checked' : '' ?> required>
      <label for="aktif">Aktif</label>
      <input type="radio" id="tidak_aktif" name="status" value="Tidak Aktif" <?= ($status == 'Tidak Aktif') ? 'checked' : '' ?>>
      <label for="tidak_aktif">Tidak Aktif</label>
    </div>

    <br>
    <button type="submit" class="btn">Update</button>
    <a href="index.php" class="btn btn-batal">Batal</a>
  </form>
</div>
</body>
</html>