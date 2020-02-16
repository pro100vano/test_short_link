<?php

$data = $_POST;

$db = mysqli_connect("localhost", "root", "root", "short_link");

if (!$db){
    echo "DB connect error!";
    exit();
}

$user = mysqli_fetch_assoc($db->query("SELECT * FROM `user` WHERE `login` = '" . $data['login'] . "'"));

if($user){
    if($data['pass'] == $user['pass']){
        echo json_encode(['Success' => 'Удачная авторизация!']);
        setcookie("admin", 'true', time()+3600);
    }else{
        echo json_encode(['Error' => 'Неверный пароль!']);
    }
}else{
    echo json_encode(['Error' => 'Такого пользоватуля не существует!']);
}
