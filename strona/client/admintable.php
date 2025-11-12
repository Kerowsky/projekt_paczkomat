<?php


require_once "config.php";
$conn = @new mysqli($servername, $username, $password, $dbname);
if (@$conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id_paczki, Uzytkownicy.id_uzytkownika AS 'id_uzytkownika',
concat(Uzytkownicy.imie,' ', Uzytkownicy.nazwisko) AS 'imie_nazwisko',
id_skrytki, status, nadawca, data_nadania, data_odebrania
FROM Paczki JOIN Uzytkownicy
ON Paczki.id_uzytkownika = Uzytkownicy.id_uzytkownika
order by id_uzytkownika asc";

$result = @$conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_paczki"] . "</td>";
        echo "<td>" . $row["imie_nazwisko"] . "</td>";
        echo "<td>" . $row["nadawca"] . "</td>";
        echo "<td>" . $row["id_skrytki"] . "</td>";
        echo "<td>" . $row["data_nadania"] . "</td>";
        if($row["status"] == "NADANA"){
            echo "<td><span class='badge rounded-pill text-bg-light'>SENT</span></td>";
        }
        elseif($row["status"] == "W_PACZKOMACIE"){
            echo "<td><span class='badge rounded-pill text-bg-secondary'>IN LOCKER</span></td>";
        }
        elseif($row["status"] == "ODEBRANA"){
            echo "<td><span class='badge rounded-pill text-bg-success'>COLLECTED</span></td>";
        }
        echo
            '<td>
<div class="row">
            <div class="dropdown col-3">
        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            STATUS
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="deleteParcel('.$row["id_paczki"].')">Delete</a></li>
            <li><a class="dropdown-item" href="#">Change status</a></li>
            <li><a class="dropdown-item" href="#">cos nowego</a></li>
        </ul>
    </div>
</div>
        
        </td>';
    }
}

?>