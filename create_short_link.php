<?php
$link = $_POST['link'];
$short_link = "";

$result = '';
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    $result .= 'https://';
} else {
    $result .= 'http://';
}
$result .= $_SERVER['SERVER_NAME'];

function is_url($in){
    $w = "a-z0-9";
    $url_pattern = "#( 
    (?:f|ht)tps?://(?:www.)? 
    (?:[$w\\-.]+/?\\.[a-z]{2,4})/? 
    (?:[$w\\-./\\#]+)? 
    (?:\\?[$w\\-&=;\\#]+)? 
    )#xi";

    $a = preg_match($url_pattern,$in);
    return $a;
}

if (!is_url($link)){
    exit();
}

function create_short_link(){
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 10);
}

$db = mysqli_connect("localhost", "root", "root", "short_link");

if (!$db){
    echo "DB connect error!";
    exit();
}

$link_exist = mysqli_fetch_assoc($db->query("SELECT `short_link` FROM `links` WHERE `link` = '" . $link . "'"))['short_link'];

if( $link_exist ){
    $result .= "?".$link_exist;
    echo $result;
    exit();
}

$i = 0;
while( $i < 1) {
    $short_link = create_short_link();
    if (!$db->query("SELECT * FROM `links` WHERE `short_link` = " . $short_link)){
        $i ++;
    }
}

$db->query("INSERT INTO `links`(`link`, `short_link`) VALUES ('".$link."', '".$short_link."')");


$result .= "?".$short_link;

echo $result;