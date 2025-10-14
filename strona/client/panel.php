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
    <title>NextBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark" onload="startTime()">
<header class="p-3 mb-3 border-bottom text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-evenly mb-md-0">
                <li>
                    <a href="index.php" class="nav-link px-2 text-secondary">Home</a>
                </li>
                <li>
                    <a href="aboutus.php" class="nav-link px-2 text-white">About us</a>
                </li>
                <li>
                    <a href="map.php" class="nav-link px-2 text-white">Find your NextBox</a>
                </li>
                <li>
                    <a href="contact.php" class="nav-link px-2 text-white">Contact</a>
                </li>
            </ul>
            <div class="text-end">
                <a class="btn btn-warning" href="logout.php">Log out</a>
            </div>
        </div>
    </div>
</header>

<h1 class="text-center text-white">Good morning <?php echo $_SESSION['imie'];?> ! ☕</h1>
<main class="d-flex justify-content-center align-items-center mx-auto">
<div class="row w-50 main-box align-items-center">
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <?php

        $sql = "select * from paczki where id_uzytkownika = '$_SESSION[id_uzytkownika]' ";
        $result = @$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
    <div class='col'>
        <div class='card mb-4 rounded-3 shadow-sm bg-dark text-white'>
            <h3>Locker: " . $row['id_skrytki'] . "</h3>
            <div class='card-header py-3 bg-warning text-black'>
                <h4 class='my-0 fw-normal'>" . $row['status'] . "</h4>
            </div> <div class='card-body'>
            <ul class='list-unstyled  mb-4'>
                <li class='fw-bold'>Shipper:</li>
                <li>" . $row['nadawca'] . "</li>
                <li class='fw-bold'>Time left:</li>
                <li>-- hours</li>
            </ul>
            <button type='button' class='w-100 btn btn-lg btn-outline-warning' href='http://192.168.162.60:25565/open?box=1'>Collect</button>
        </div>
        </div>
    </div>

    ";
            }

        } else {
            echo "Nie masz paczek na koncie";
        }


        ?>


    </div>
</main>
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
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>


<?php $conn->close()?>