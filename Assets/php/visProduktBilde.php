<?php
$con = new mysqli("localhost","root","","Temp");
if ($con->connect_error) {
    die("Failed to connect to MySQL: " . $con->connect_error);
}

//Legg til produktet i vogn
$stmt = $con->prepare("SELECT bilde from PRODUKT WHERE produktID = ?");
$stmt->bind_param("d", $pid);
$pid = $_GET['id'];
$stmt->execute();
header("Content-Type: image/jpeg");
$res = [$stmt->get_result()];
echo $res['bilde'];