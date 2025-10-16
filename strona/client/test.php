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
    $sql = "SELECT * FROM `paczki`";
    $result = @$conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_paczki"] . "</td>";
        echo "<td>" . $row["DO"] . "</td>";
        echo "<td>" . $row["nadawca"] . "</td>";
        echo "<td>" . $row["NR_SKRYTKI"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td>";
    }
    }

    ?>
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