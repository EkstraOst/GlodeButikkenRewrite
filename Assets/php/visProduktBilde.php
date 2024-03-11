<?php
function getBilde($pid) {
    $con = new mysqli("localhost","root","","Temp");
    if ($con->connect_error) {
        die("Failed to connect to MySQL: " . $con->connect_error);
    }

    $stmt = $con->prepare("SELECT bilde from PRODUKT WHERE produktID = ?");
    $stmt->bind_param("b", $pid);
    $pid = $_GET['id'];
    $stmt->execute();
    $res = [$stmt->get_result()];
    echo base64_encode($res['bilde']);
}

?>