<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $slot = $_POST['slot'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE slot_parkir SET status=? WHERE nama_slot=?");
    $stmt->bind_param("ss", $status, $slot);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status" => "success", "message" => "Status slot diperbarui"]);
}
?>