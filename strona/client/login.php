<?php
// login.php
session_start();

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