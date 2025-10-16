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
    <?php
    $sql = "SELECT id_paczki, uzytkownicy.id_uzytkownika AS 'id_uzytkownika',
concat(uzytkownicy.imie,' ', uzytkownicy.nazwisko) AS 'imie_nazwisko',
id_skrytki, status, nadawca, data_nadania, data_odebrania
FROM paczki JOIN uzytkownicy
ON paczki.id_uzytkownika = uzytkownicy.id_uzytkownika
order by id_uzytkownika asc";
    $result = @$conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_paczki"] . "</td>";
        echo "<td>" . $row["imie_nazwisko"] . "</td>";
        echo "<td>" . $row["nadawca"] . "</td>";
        echo "<td>" . $row["id_skrytki"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo '<td>
            <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
        
        
        </td>';
    }
    }

    ?>




    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>

