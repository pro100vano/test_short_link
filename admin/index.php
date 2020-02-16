<?php

if (!isset($_COOKIE['admin'])) {
    header('Location: /admin/auth.php');
}
$db = mysqli_connect("localhost", "root", "root", "short_link");

$links = $db->query("SELECT * FROM `links`");

$result = '';
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    $result .= 'https://';
} else {
    $result .= 'http://';
}
$result .= $_SERVER['SERVER_NAME'] . "?";

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <h2>Short Link | Администартор</h2>
</header>

<main>
    <div class="list-wrapper">
        <?php for ($i = 0; $i < $links->num_rows; $i++) {
            $link = mysqli_fetch_assoc($links); ?>
            <div class="row">
                <div class="w-5"><?= $i + 1 ?>)</div>
                <div class="w-45"><a href="<?= $link['link'] ?>"><?= substr($link['link'], 0, 55); ?></a></div>
                <div class="w-45"><a href="<?= $result . $link['short_link'] ?>"><?= $link['short_link'] ?></a></div>
                <div class="w-5"><a href="/admin/delete.php?id=<?= $link['id'] ?>">Удалить</a></div>
            </div>
        <?php } ?>
    </div>
</main>

</body>
</html>