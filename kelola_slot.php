<?php
include "../config/db.php";
include "../includes/auth.php";

// Tambah slot baru
if (isset($_POST['tambah'])) {
    $kode = $_POST['nama_slot'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO slot_parkir (nama_slot, status) VALUES (?, ?)");
    $stmt->bind_param("ss", $kode, $status);
    $stmt->execute();
    $stmt->close();

    header("Location: kelola_slot.php");
    exit();
}

// Hapus slot
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM slot_parkir WHERE id=$id");
    header("Location: kelola_slot.php");
    exit();
}

// Update status slot
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE slot_parkir SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: kelola_slot.php");
    exit();
}

// Ambil data slot
$result = $conn->query("SELECT * FROM slot_parkir ORDER BY nama_slot ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Slot Parkir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary mb-4">
  <div class="container-fluid">
    <span class="navbar-brand">Smart Parking - Kelola Slot</span>
    <a href="dashboard.php" class="btn btn-light">Kembali</a>
  </div>
</nav>

<div class="container">
  <h3 class="mb-4">Daftar Slot Parkir</h3>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Nama Slot</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama_slot']) ?></td>
        <td>
          <form method="POST" class="d-flex">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <select name="status" class="form-select me-2">
              <option value="kosong" <?= $row['status']=='kosong'?'selected':'' ?>>Kosong</option>
              <option value="terisi" <?= $row['status']=='terisi'?'selected':'' ?>>Terisi</option>
            </select>
            <button type="submit" name="update_status" class="btn btn-sm btn-warning">Update</button>
          </form>
        </td>
        <td>
          <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus slot ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <hr>

  <h4>Tambah Slot Baru</h4>
  <form method="POST" class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Nama Slot</label>
      <input type="text" name="nama_slot" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="kosong">Kosong</option>
        <option value="terisi">Terisi</option>
      </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" name="tambah" class="btn btn-success w-100">Tambah Slot</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
