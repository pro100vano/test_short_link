<?php
if(isset($_GET)){
    $db = mysqli_connect("localhost", "root", "root", "short_link");

    foreach ($_GET as $key => $value){
        $link = mysqli_fetch_assoc($db->query("SELECT `link` FROM `links` WHERE `short_link` = '" . $key . "'"))['link'];
        if($link){
            header('Location: ' . $link);
        }
    }
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short link - сервис сокращения ссылок</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<header>
    <h2>Short Link</h2>
</header>
<main>
    <div class="form-wrapper">
        <form id="form">
            <p>
                <input type="text" name="link" placeholder="Введите ссылку">
            </p>
            <p>
                <button name="submit">Submit</button>
            </p>
        </form>

        <div class="success">

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
                url: "/create_short_link.php",
                method: "POST",
                data: data
            }).done(function (response) {
                $('.success').text(response)
            });
        });
    });
</script>

</body>
</html>