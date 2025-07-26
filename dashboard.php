<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../config/db.php";

// Ambil data slot parkir
$query = "SELECT * FROM slot_parkir";
$result = $conn->query($query);

$total = $result->num_rows;
$terisi = 0;
$kosong = 0;

$slotData = [];
while ($row = $result->fetch_assoc()) {
    $slotData[] = $row;
    if ($row['status'] == 'terisi') {
        $terisi++;
    } else {
        $kosong++;
    }
}

// Ambil data parkir masuk & keluar
$masuk = $conn->query("SELECT * FROM parkir_masuk ORDER BY waktu_masuk DESC");
$keluar = $conn->query("SELECT * FROM parkir_keluar ORDER BY waktu_keluar DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1>Selamat Datang, Admin!</h1>
    <hr>

    <div class="row mb-4">
      <div class="col">
        <div class="list-group">
          <a href="kelola_slot.php" class="list-group-item list-group-item-action">Kelola Slot Parkir</a>
          <a href="dashboard.php" class="list-group-item list-group-item-action active">Dashboard</a>
          <a href="logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-md-4">
        <div class="alert alert-primary">Total Slot: <?= $total ?></div>
      </div>
      <div class="col-md-4">
        <div class="alert alert-success">Slot Kosong: <?= $kosong ?></div>
      </div>
      <div class="col-md-4">
        <div class="alert alert-danger">Slot Terisi: <?= $terisi ?></div>
      </div>
    </div>

    <h2 class="mt-4">Riwayat Parkir Masuk</h2>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>ID Kartu</th>
          <th>Plat Nomor</th>
          <th>Waktu Masuk</th>
          <th>Slot</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $masuk->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['id_kartu'] ?></td>
          <td><?= $row['plat_nomor'] ?></td>
          <td><?= $row['waktu_masuk'] ?></td>
          <td><?= $row['slot'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <h2 class="mt-5">Riwayat Parkir Keluar</h2>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>ID Kartu</th>
          <th>Plat Nomor</th>
          <th>Waktu Keluar</th>
          <th>Slot</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $keluar->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['id_kartu'] ?></td>
          <td><?= $row['plat_nomor'] ?></td>
          <td><?= $row['waktu_keluar'] ?></td>
          <td><?= $row['slot'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>
</body>
</html>