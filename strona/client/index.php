<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "InteligentnaSkrytka";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select * from paczki";
?>

<html>
<head>
<title>Inteligentny paczkomat</title>
</head>
<body>
<div id="test">

    <?php
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id_paczki"]. " ". $row["id_klienta"]. " " . $row["id_kuriera"]. " " . $row["id_skrytki"]. " " . $row["status"].  " </br>";
        }
    } else {
        echo "0 results";
    }
    ?>
</div>
</body>
</html>
