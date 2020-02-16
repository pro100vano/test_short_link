<?php

if(isset($_GET['id'])){
    $db = mysqli_connect("localhost", "root", "root", "short_link");
    $links = $db->query("DELETE FROM `links` WHERE `id` = " . $_GET['id']);
    header('Location: /admin/');
}