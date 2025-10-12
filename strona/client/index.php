
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/logowanie.css">
    <link rel="stylesheet" href="style/register.css">
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Log in</h1>
        <form action="login.php" method="post">
            <p>
                <input type="text" name="username" placeholder="Username" required autocomplete="off">
            </p>
            <p>
                <input type="password" name="password" placeholder="Password" required>
            </p>
            <p>
                <input type="submit" value="Log in">
            </p>
            <p>
                <input type="button" value="Sign in" onclick="startRegister()">
            </p>
        </form>
            <form action="register.php" method="post" id="registerForm" style="display: ;">
                <p>
                    <input type="text" name="imie" placeholder ="name" required>
                </p>
                <p>
                    <input type="text" name="nazwisko" placeholder ="name" required>
                </p>
                <p>
                    <input type="text" name="username" placeholder ="name" required>
                </p>
                <p>
                    <input type="password" name="password" placeholder ="name" required>
                </p>
                <p>
                    <input type="password" name="password" placeholder ="name" required>
                </p>
            </form>
    </div>
</body>
</html>

<?php
echo "Gowno";
?>