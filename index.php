<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Mata Kuliah</title>
<style>
  body{font-family:Arial,sans-serif;margin:0;background:#f4f6f9;color:#222}
  .wrap{max-width:1000px;margin:30px auto;padding:0 16px}
  h1{font-size:22px}
  .btn{display:inline-block;padding:7px 14px;border-radius:6px;color:#fff;text-decoration:none;font-size:14px;border:0;cursor:pointer}
  .btn-primary{background:#2563eb}.btn-warning{background:#d97706}.btn-danger{background:#dc2626}
  .alert{padding:10px 14px;border-radius:6px;background:#dbeafe;margin:14px 0}
  .tabel-scroll{overflow-x:auto}
  table{width:100%;border-collapse:collapse;background:#fff;margin-top:14px}
  th,td{padding:10px;border-bottom:1px solid #e5e7eb;text-align:left;font-size:14px}
  th{background:#1e3a8a;color:#fff}
  .badge{padding:3px 10px;border-radius:12px;color:#fff;font-size:12px}
  .badge-success{background:#16a34a}.badge-danger{background:#dc2626}
</style>
</head>
<body>
<div class="wrap">
  <h1>Sistem Manajemen Data Mata Kuliah</h1>
  <a class="btn btn-primary" href="index.php?action=create">+ Tambah Mata Kuliah</a>

  <?php
  $pesan = ['created'=>'Data berhasil ditambahkan.', 'updated'=>'Data berhasil diperbarui.',
            'deleted'=>'Data berhasil dihapus.', 'error'=>'Terjadi kesalahan.'];
  if (isset($pesan[$msg])): ?>
    <div class="alert"><?= htmlspecialchars($pesan[$msg], ENT_QUOTES, 'UTF-8') ?></div>
  <?php endif; ?>

  <div class="tabel-scroll">
  <table>
    <tr><th>No</th><th>Kode</th><th>Nama Mata Kuliah</th><th>Program Studi</th>
        <th>Smt</th><th>SKS</th><th>Status</th><th>Aksi</th></tr>
    <?php $no = 1; foreach ($mata_kuliah as $row): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['KodeMataKuliah'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($row['NamaMataKuliah'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($row['ProgramStudi'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($row['Semester'], ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= htmlspecialchars($row['SKS'], ENT_QUOTES, 'UTF-8') ?></td>
      <td>
        <?php $b = ($row['Status'] == 'Aktif') ? 'badge-success' : 'badge-danger'; ?>
        <span class="badge <?= $b ?>"><?= htmlspecialchars($row['Status'], ENT_QUOTES, 'UTF-8') ?></span>
      </td>
      <td>
        <a class="btn btn-warning" href="index.php?action=edit&id=<?= (int)$row['IdMataKuliah'] ?>">Edit</a>
        <a class="btn btn-danger" href="index.php?action=delete&id=<?= (int)$row['IdMataKuliah'] ?>"
           onclick="return confirm('Yakin ingin menghapus mata kuliah ini?');">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  </div>
</div>
</body>
</html>