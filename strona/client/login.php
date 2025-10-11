<?php
session_start();
require_once "config.php";
// login.php
$conn = @new mysqli($servername, $username, $password, $dbname);
if (@$conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login = isset($_POST['username']) ? $_POST['username'] : '';
$haslo = isset($_POST['password']) ? $_POST['password'] : '';

$sql = "select * from Uzytkownicy where login='$login' and haslo='$haslo' ";

if ($result = @$conn->query($sql)) {
    $user = $result->num_rows;
    if($user > 0){
        $row = $result->fetch_assoc();
        $user = $row["login"];
        $_SESSION['zalogowany'] = true;
        $_SESSION['imie'] = $row['imie'];

        $result->free();
        header("Location:panel.php");
    }
    else {
        echo "❌ Błędny login lub hasło.";
        echo "<br><a href='index.php'>Spróbuj ponownie</a>";
    }

}
?>
<?php


$conn->close();
?>
