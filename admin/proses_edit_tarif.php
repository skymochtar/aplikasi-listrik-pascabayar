<?php
require_once '../config/database.php';

// Proteksi & Verifikasi Form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {

    $id_tarif = $_POST['id_tarif'];
    $daya = $_POST['daya'];
    $tarifperkwh = $_POST['tarifperkwh'];

    $sql = "UPDATE tarif SET daya = '$daya', tarifperkwh = '$tarifperkwh' WHERE id_tarif = $id_tarif";

    if (mysqli_query($conn, $sql)) {
        header("Location: kelola_tarif.php?status=edit_sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    header("Location: ../auth/login.php");
}
?>