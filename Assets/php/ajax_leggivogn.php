<?php

$conn = mysqli_connect("localhost", "root", "", "Temp");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$query = "INSERT INTO VOGN_ITEM (kundeID, produktID) VALUES (" . $_SESSION['id'] . ", " . $_GET['pid'] . ")";
echo $query;
if (mysqli_query($conn, $query)) {
    $query2 = "SELECT COUNT(*) as count FROM (SELECT * FROM VOGN_ITEM WHERE kundeID = " . $_SESSION['id'] . ")";
    if ($result = mysqli_query($conn, $query2)) {
        $row = mysqli_fetch_assoc($result);
        echo $row['count'];
    }
} else {
    echo "INGENTING TINGELING";
}

