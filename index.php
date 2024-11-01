<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>basic reg/aurh form</title>
</head>
<body>
<div class="cont">
    <form id="form1" class="auth_form" action="auth.php" method="post">
        <strong>Авторизация</strong><br>
        <input type="text" name="name" placeholder="Ваш никнейм" required><br>
        <input type="password" name="pass" placeholder="Ваш Пароль" required><br>
        <p class="text">Нет аккаунта? <a href="#" id="switchToRegister">Регистрация</a></p><br>
        <input type="submit" value="Войти">
    </form>

    <form id="form2" class="auth_form hidden" action="reg.php" method="post">
        <strong>Регистрация</strong><br>
        <input type="text" name="name" placeholder="Ваш никнейм" required><br>
        <input type="password" name="pass" placeholder="Ваш Пароль" required><br>
        <input type="password" name="repeatpass" placeholder="Повторите ваш Пароль" required><br>
        <input type="email" name="email" placeholder="Почта" required><br>
        <p class="text">Уже зарегистрированы? <a href="#" id="switchToLogin">Вход в аккаунт</a></p><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
</div>
<script src="script/script.js"></script>
</body>
</html>