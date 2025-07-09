<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    $daya = $_POST['daya'];
    $tarifperkwh = $_POST['tarifperkwh'];

    $sql = "INSERT INTO tarif (daya, tarifperkwh) VALUES ('$daya', '$tarifperkwh')";

    if (mysqli_query($conn, $sql)) {
        header("Location: kelola_tarif.php?status=sukses_tambah");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: ../auth/login.php");
}
?>