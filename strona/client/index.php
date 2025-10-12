
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
        <form action="login.php" method="post" style="display: ;">
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
        <form action="register.php" method="post" id="registerForm" style="display:;">
            <p>
                <input type="button" name="close" value="X">
            </p>
            <p>
                <input type="text" name="nameReg" placeholder ="Name" required>
            </p>
            <p>
                <input type="text" name="surnameReg" placeholder ="Surname" required>
            </p>
            <p>
                <input type="text" name="usernameReg" placeholder ="Username" required>
            </p>
            <p>
                <input type="password" name="passwordReg" placeholder ="Password" required>
            </p>
            <p>
                <input type="password" name="password" placeholder="Repeat password" required disabled>
            </p>
            <p>
                <input type="submit" value="Sign up">
            </p>
        </form>
    </div>
</body>
</html>