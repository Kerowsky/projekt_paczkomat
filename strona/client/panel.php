<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: index.php");
    exit;
}

require_once "config.php";
$conn = @new mysqli($servername, $username, $password, $dbname);
if (@$conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html lang="pl">
<head>
    <title>Inteligentny paczkomat</title>
    <link rel="stylesheet" href="style/panel.css">
</head>
<body onload="startTime()">
<header class="mainHeader" role="banner">
    <div class="content">
        <a class="mainLogo">
            JAKIESLOGO
        </a>
        <h3 id="zegar">21:15:00</h3>
        <h3>WYLOGUJ</h3>
    </div>

</header>

<h1>Witaj <?php echo $_SESSION['imie'];?> !</h1>
<div id="paczki">
    <table>
        <tr>
            <th>ID Paczki</th>
            <th>ID Skrytki</th>
            <th>Status przesyłki</th>
            <th>Nadawca</th>
        </tr>
    <?php
    $sql = "select * from paczki where id_uzytkownika = '$_SESSION[id_uzytkownika]' ";
    $result = @$conn->query($sql);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            echo "<tr><td>".$row["id_paczki"]."</td><td>".$row['id_skrytki']."</td><td>". $row['status']. "</td>
               <td>". $row['nadawca']. "</td><td><a href='http://192.168.162.60:25565/open?box=1'>Otworz skrytke</></td></tr>";
        }

    }
    else{
        echo "Nie masz paczek na koncie";
    }
    ?>
    </table>
</div>
<?php echo "<a href='logout.php'>Wyloguj</a>";?>
<script>
    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('zegar').innerHTML =  h + ":" + m + ":" + s;
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};
        return i;
    }
</script>
</body>
</html>


<?php $conn->close()?>