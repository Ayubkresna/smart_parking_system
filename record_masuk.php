<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_kartu = $_POST['id_kartu'];
    $plat_nomor = $_POST['plat_nomor'];
    $slot = $_POST['slot'];

    // Simpan ke tabel parkir_masuk
    $stmt = $conn->prepare("INSERT INTO parkir_masuk (id_kartu, plat_nomor, slot) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id_kartu, $plat_nomor, $slot);
    $stmt->execute();
    $stmt->close();

    // Update slot jadi 'terisi'
    $update = $conn->prepare("UPDATE slot_parkir SET status='terisi' WHERE nama_slot=?");
    $update->bind_param("s", $slot);
    $update->execute();
    $update->close();

    echo json_encode(["status" => "success", "message" => "Data parkir masuk tercatat"]);
}
?>
