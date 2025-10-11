<?php
require_once "config.php";
// login.php
$conn = @new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select * from paczki";

$login = isset($_POST['username']) ? $_POST['username'] : '';
$haslo = isset($_POST['password']) ? $_POST['password'] : '';


// przykładowe dane (docelowo będą w bazie)
$poprawny_login = "admin";
$poprawne_haslo = "1234";

if ($login === $poprawny_login && $haslo === $poprawne_haslo) {
    $_SESSION['zalogowany'] = true;
    echo "✅ Zalogowano poprawnie!";
    echo "<br><a href='panel.php'>Przejdź do panelu</a>";
} else {
    echo "❌ Błędny login lub hasło.";
    echo "<br><a href='login.html'>Spróbuj ponownie</a>";
}
?>
<?php
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id_paczki"]. " ". $row["id_klienta"]. " " . $row["id_kuriera"]. " " . $row["id_skrytki"]. " " . $row["status"].  " </br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
