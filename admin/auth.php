<?php

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - авторизация</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <h3>Авторизация</h3>
</header>
<main>
    <div class="form-wrapper">
        <form id="form">
            <p>
                <input type="text" name="login" placeholder="Логин">
            </p>
            <p>
                <input type="password" name="pass" placeholder="Пароль">
            </p>
            <p>
                <button name="submit">Log in</button>
            </p>
        </form>

        <div class="success">

        </div>

        <div class="error">

        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(function () {
       $('#form').on('submit', function (e) {
           e.preventDefault();
           var data = $(this).serializeArray();
           $.ajax({
               url: '/admin/log_in.php',
               data: data,
               method: "POST"
           }).done(function (response) {
               var result = JSON.parse(response);
               if(result.Error){
                   $('.error').text(result.Error);
               }else{
                   $('.success').text(result.Success);
                   window.location.replace('/admin/');
               }
           })
       })
    });
</script>

</body>
</html>
