<?php

$url = explode("?", $_SERVER['HTTP_REFERER']);

// подключаем WordPress
// тут указан правильный путь, если profile-update.php находится непосредственно в папке с темой
require_once(dirname(__FILE__) . '/../../../../wp-load.php');

// если не авторизован, просто выходим из файла
if (!is_user_logged_in()) exit;

// получаем объект пользователя с необходимыми данными
$user_ID = get_current_user_id();
$user = get_user_by('id', $user_ID);
if($_POST['unset_private']){
    $string =  $_POST['unset_private'];
    $str_arr = preg_split("/\,/", $string);
    foreach($str_arr as $puc){
        carbon_set_post_meta($puc, 'privat_image', 'no_private');
    }
}

header('location:' . $url[0] . '?status=ok');
exit;