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

<html lang="pl">
<head>
    <title>Inteligentny paczkomat</title>
    <link rel="stylesheet" href="style/panel.css">
    <title>NextBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body onload="startTime()">
<?php
include 'header.php';
?>

<h1>Good morning <?php echo $_SESSION['imie'];?> ! ☕</h1>
<main class="d-flex justify-content-center align-items-center mx-auto">
<div class="row w-50 main-box align-items-center">
    <div class="col-md-3 paczka bg-black m-1 shadow-sm bg-body-tertiary rounded">
        <h2>NAZWA PACKING</h2>
        <h4>STATUS PACZKI</h4>
        <button class="btn btn-warning">Collect</button>
    </div>
    <div class="col-md-3 paczka bg-black m-1 shadow-smbg-body-tertiary">
        <h2>NAZWA PACKING</h2>
        <h4>STATUS PACZKI</h4>
        <button class="btn btn-warning">Collect</button>
    </div>
    <div class="col-md-3 paczka bg-black  m-1shadow-sm  bg-body-tertiary">
        <h2>NAZWA PACKING</h2>
        <h4>STATUS PACZKI</h4>
        <button class="btn btn-warning">Collect</button>
    </div>
    <div class="col-md-3 paczka bg-black  m-1shadow-sm bg-body-tertiary">
        <h2>NAZWA PACKING</h2>
        <h4>STATUS PACZKI</h4>
        <button class="btn btn-warning">Collect</button>
    </div>
    <div class="col-md-3 paczka bg-black  m-1 shadow-sm bg-body-tertiary">
        <h2>NAZWA PACKING</h2>
        <h4>STATUS PACZKI</h4>
        <button class="btn btn-warning">Collect</button>
    </div>

</div>
</main>
<script>
    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('zegar').innerHTML =  h + ":" + m + ":" + s;
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};
        return i;
    }
</script>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>


<?php $conn->close()?>