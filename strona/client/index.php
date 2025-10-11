
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/logowanie.css">
    <title>Logowanie</title>
</head>
<body>
    <div>
        <h1>Zaloguj się</h1>
        <form action="login.php" method="post">
            <p>
                <input type="text" name="username" placeholder="Nazwa użytkownika" required autocomplete="off">
            </p>
            <p>
                <input type="password" name="password" placeholder="Hasło" required>
            </p>
            <p>
                <input type="submit" value="Zaloguj">
            </p>
        </form>
    </div>
</body>
</html>
