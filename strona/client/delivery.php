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

    <html lang="pl" xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Inteligentny paczkomat</title>
        <link rel="stylesheet" href="style/panel.css">
        <title>NextBox</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="delivery.css">
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
                if($_SESSION['rola'] == 'KURIER'){
                    echo "
                 <div class='text-end'>
                <a class='btn btn-warning me-1' href='delivery.php'>Delivery panel</a>
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
        <div class="container">
            <h1 class="text-center">LIST OF ORDERS</h1>
                <table class="text-center table table-striped table-hover table-bordered table-dark">
                    <thead class="thead-warrnig text-dark">
                        <tr>
                            <th>PACKAGE NUMBER</th>
                            <th>ORDER NUMBER</th>
                            <th>SENDER</th>
                            <th>RECIPIENT</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $conn = @new mysqli($servername, $username, $password, $dbname);
                    if (@$conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "
                            SELECT 
                                paczki.id_paczki,
                                paczki.nr_zamowienia,
                                paczki.nadawca,
                                CONCAT(uzytkownicy.imie, ' ', uzytkownicy.nazwisko) AS odbiorca,
                                paczki.status
                            FROM Paczki 
                            JOIN uzytkownicy ON paczki.id_uzytkownika = uzytkownicy.id_uzytkownika
                            LEFT JOIN paczkomat ON paczki.id_skrytki = paczkomat.id_skrytki
                            ";
                    $result = @$conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($row['status'] == 'W_PACZKOMACIE'){
                                $status_text='LOCKER';
                            }else{
                                $status_text='ON THE WAY';
                            }
                            echo "<tr>
                                        <td>{$row['id_paczki']}</td>
                                        <td>{$row['nr_zamowienia']}</td>
                                        <td>{$row['nadawca']}</td>
                                        <td>{$row['odbiorca']}</td>
                                        <td>{$row['status']}</td>
                                        <td>
                                            <button class='btn btn-success'>Open</button>
                                            <button class='btn btn-danger'>Change Status</button>
                                        </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Brak paczek w bazie</td></tr>";
                    }

                    $conn->close();
                    ?>
                    </tbody>
                </table>
        </div>
    </main>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    </body>
    </html>


<?php $conn->close()?>