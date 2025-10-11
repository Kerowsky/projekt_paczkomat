<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<html lang="pl">
<head>
    <title>Inteligentny paczkomat</title>
    <link rel="stylesheet" href="style/panel.css">
</head>
<body>
<h1>Witaj <?php echo $_SESSION['imie'];?> !</h1>
<a href="http://192.168.162.60:25565/open?box=1">Otworz skrytke</a>
<div id="paczki">
    <div class="paczka" id="paczka1">sratytaty</div>
</div>
<?php echo "<a href='logout.php'>Wyloguj</a>";?>
</body>
</html>

