<?php
session_start();

if ($_SESSION["rola"] != "ADMIN") {
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
    <link rel="stylesheet" href="style/admin.css">
    <title>NextBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-dark" onload="startTime()">
<header class="p-3 mb-3 text-bg-dark">
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
            <?php
            if($_SESSION['rola'] == 'KURIER' || $_SESSION['rola'] == 'ADMIN'){
                echo "
                <div class='text-end'>
                    <a class='btn btn-warning me-1' href='delivery.php'>Delivery panel</a>
                </div>
            ";
            }
            if($_SESSION['rola'] == 'ADMIN'){
                echo "
                <div class='text-end'>
                    <a class='btn btn-danger me-1' href='admin.php'>Admin panel</a>
                </div>
                ";
                }
            ?>
            <div class="text-end">
                <a class="btn btn-warning" href="logout.php">Log out</a>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="table-responsive small">
        <table class="table table-striped table-sm table-dark">
            <thead>
            <tr class="bg-dark">
                <th scope="col">NUMER PACZKI</th>
                <th scope="col">DO</th>
                <th scope="col">OD</th>
                <th scope="col">NR SKRYTKI</th>
                <th scope="col">STATUS</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1,001</td>
                <td>random</td>
                <td>data</td>
                <td>placeholder</td>
                <td><span class="badge rounded-pill text-bg-secondary">W PACZKOMACIE</span></td>
                <td>BUTTON</td>
            </tr>
            <tr>
                <td>1,002</td>
                <td>placeholder</td>
                <td>irrelevant</td>
                <td>visual</td>
                <td><span class="badge rounded-pill text-bg-success">ODEBRANA</span></td>
                <td>BUTTON</td>
            </tr>
            <tr>
                <td>1,003</td>
                <td>data</td>
                <td>rich</td>
                <td>dashboard</td>
                <td><span class="badge rounded-pill text-bg-light">NADANA</span></td>
                <td>BUTTON</td>
            </tr>
            </tbody>
        </table>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>


<?php $conn->close()?>