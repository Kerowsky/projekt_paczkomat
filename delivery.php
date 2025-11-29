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
                <table class="text-center table table-striped table-hover table-bordered table-dark"> //utworzenie tabeli dla kuriera
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
                    $conn = @new mysqli($servername, $username, $password, $dbname); //połączenie tabeli z baza danych
                    if (@$conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "
                            SELECT 
                                Paczki.id_paczki,
                                Paczki.nr_zamowienia,
                                Paczki.nadawca,
                                CONCAT(Uzytkownicy.imie, ' ', Uzytkownicy.nazwisko) AS Odbiorca,
                                Paczki.status
                            FROM Paczki 
                            JOIN Uzytkownicy ON Paczki.id_uzytkownika = Uzytkownicy.id_uzytkownika
                            LEFT JOIN Paczkomat ON Paczki.id_skrytki = Paczkomat.id_skrytki
                            ORDER BY 
                                CASE
                                    WHEN Paczki.status='W_PACZKOMACIE' then 1
                                    ELSE 0
                                END,
                                Paczki.id_paczki ASC;
                                    
                                    
                            ";
                    $result = @$conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id_paczki']}</td>";
                            echo "<td>{$row['nr_zamowienia']}</td>";
                            echo "<td>{$row['nadawca']}</td>";
                            echo "<td>{$row['Odbiorca']}</td>";

                            if ($row["status"] == "W_PACZKOMACIE") {
                                echo "<td>IN LOCKER</td>";
                            } else {
                                echo "<td>ON THE WAY</td>";
                            }
                            echo "<td>";
                            if ($row["status"] == "NADANA") {
                                echo "<button class='btn btn-success'>Open</button>";
                                echo "<button class='btn btn-primary'>Change Status</button>";
                            }
                            else{
                                echo "<button class='btn btn-danger'>Support</button>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No packages in database</td></tr>";
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