<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: index.php");
    exit;
}

echo "<h1>Witaj w panelu!</h1>";
echo "<a href='logout.php'>Wyloguj</a>";
?>

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
<a href="http://192.168.162.60:25565/open?box=1">Otworz skrytke</a>
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

