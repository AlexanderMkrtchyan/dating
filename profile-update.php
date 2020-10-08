<?php
// $_SERVER['HTTP_REFERER'] - полный URL страницы, откуда пришел пользователь
// $url[0] - без GET параметров
// это нам понадобится для правильных редиректов
$url = explode("?", $_SERVER['HTTP_REFERER']);

require_once("../../../wp-load.php");

// если не авторизован, просто выходим из файла
if (!is_user_logged_in()) exit;

// получаем объект пользователя с необходимыми данными
$user_ID = get_current_user_id();
$user = get_user_by('id', $user_ID);


// сначала обработаем пароли, ведь если при сохранении пользователь ничего не указал ни в одном поле пароля, то пропускаем эту часть
if ($_POST['pwd1'] || $_POST['pwd2'] || $_POST['pwd3']) {

    // при этом пользователь должен заполнить все поля
    if ($_POST['pwd1'] && $_POST['pwd2'] && $_POST['pwd3']) {

        // сначала проверяем соответствие нового пароля и его подтверждения
        if ($_POST['pwd2'] == $_POST['pwd3']) {

            // пароль из двух символов нам не нужен, минимум 8
            if (strlen($_POST['pwd2']) < 8) {
                // если слишком короткий - перенаправляем
                header('location:' . $url[0] . '?status=short');
                exit;
            }

            // и самое главное - проверяем, правильно ли указан старый пароль
            if (wp_check_password($_POST['pwd1'], $user->data->user_pass, $user->ID)) {
                // если да, меняем на новый и заново авторизуем пользователя
                wp_set_password($_POST['pwd2'], $user_ID);
                $creds['user_login'] = $user->user_login;
                $creds['user_password'] = $_POST['pwd2'];
                $creds['remember'] = true;
                $user = wp_signon($creds, false);
            } else {
                // если нет, перенаправляем на ошибку
                header('location:' . $url[0] . '?status=wrong');
                exit;
            }
        } else {
            // новый пароль и его подтверждение не соответствуют друг другу
            header('location:' . $url[0] . '?status=mismatch');
            exit;
        }
    } else {
        // не все поля заполнены - перенеправляем
        header('location:' . $url[0] . '?status=required');
        exit;
    }
}

// допустим, что Имя, Фамилия и Емайл - обязательные поля, Город - не обязательное
if ($_POST['first_name'] && $_POST['last_name'] && is_email($_POST['email'])) {
    // если пользователь указал новый емайл, а кто-то уже под ним зареган - отправляем на ошибку
    if (email_exists($_POST['email']) && $_POST['email'] != $user->user_email) {
        header('location:' . $url[0] . '?status=exist');
        exit;
    }

    // updating user meta
    wp_update_user(array(
        'ID' => $user_ID,
        'user_email' => $_POST['email'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'display_name' => $_POST['first_name'] . ' ' . $_POST['last_name'],
        'age' => $_POST['age'],
    ));

    // Updating user meta
    if($_POST['klri_glox'] != ''){
        $default_img_id =  attachment_url_to_postid($_POST['klri_glox']);
        update_user_meta($user_ID, 'klri_glox', $default_img_id);
        update_user_meta($user_ID, 'profile_image', wp_get_attachment_image_src( $default_img_id, 'thumbnail',  true )[0]); 
    }
    
    //$default_img_link = wp_get_attachment_image_src( $default_img_id, 'thumbnail',  true )[0];

    update_user_meta($user_ID, 'drinking', $_POST['drinking']);

    update_user_meta($user_ID, 'gender', $_POST['gender']);
    update_user_meta($user_ID, 'ethnicity', $_POST['ethnicity']);
    update_user_meta($user_ID, 'looking_for', $_POST['looking_for']);
    update_user_meta($user_ID, 'looking_for_in', $_POST['looking_for_in']);
    update_user_meta($user_ID, 'state', $_POST['state']);
    update_user_meta($user_ID, 'city', $_POST['city']);
    update_user_meta($user_ID, 'age', $_POST['age']);
    update_user_meta($user_ID, 'puc', $_POST['puc']);
    
    update_user_meta($user_ID, 'time_offset_registration', $_POST['time_offset_registration']);

    update_user_meta($user_ID, 'education', $_POST['education']);

    update_user_meta($user_ID, 'about_me', $_POST['about_me']);
    update_user_meta($user_ID, 'hobby', $_POST['hobby']);
    update_user_meta($user_ID, 'size', $_POST['size']);
    update_user_meta($user_ID, 'user_select', $_POST['user_select']);
    update_user_meta($user_ID, 'user_tatoo', $_POST['user_tatoo']);
    update_user_meta($user_ID, 'piercings', $_POST['piercings']);
    update_user_meta($user_ID, 'hair_color', $_POST['hair_color']);
    update_user_meta($user_ID, 'eye_color', $_POST['eye_color']);
    update_user_meta($user_ID, 'relationship', $_POST['relationship']);
    update_user_meta($user_ID, 'kids', $_POST['kids']);
    update_user_meta($user_ID, 'smoking', $_POST['smoking']);

        update_user_meta($user_ID, 'language', $_POST['language']);
    update_user_meta($user_ID, 'income', $_POST['income']);
    update_user_meta($user_ID, 'age', $_POST['age']);
} else {
    // If not all required fields are filled
    header('location:' . $url[0] . '?status=required');
    exit;
}


if($_POST['delete_image']){
    
    $string =  $_POST['delete_image'];
    $tempData = str_replace("\\", "",$string);
    $cleanData = json_decode($tempData);

    foreach($cleanData as $img_src){
        wp_delete_attachment($img_src,false);        
    }
}

if($_POST['image_checkbox']){
    $string =  $_POST['image_checkbox'];
    
    $str_arr = preg_split("/\,/", $string);
    foreach($str_arr as $puc){
        carbon_set_post_meta($puc, 'privat_image', 'private');
    }
}

if($_POST['video_click']){
    $link = $_POST['video_click'];
    $str_arr = preg_split("/\,/", $link);
    foreach ($str_arr as $puc) {
        $id = attachment_url_to_postid($puc);
        carbon_set_post_meta($id, 'private_video', 'private_vd');
    }
}
if($_POST['unset_video_click']){
    $link = $_POST['unset_video_click'];
    $str_arr = preg_split("/\,/", $link);
    foreach ($str_arr as $puc) {
        $id = attachment_url_to_postid($puc);
        carbon_set_post_meta($id, 'private_video', '');
    }
}
if($_POST['delete_vid']){
    $link = $_POST['delete_vid'];
    $str_arr = preg_split("/\,/", $link);
    foreach ($str_arr as $puc) {
        $id = attachment_url_to_postid($puc);
        wp_delete_attachment($id);
    }
}


// если выполнение кода дошло до сюда, то следовательно всё ок
header('location:' . $url[0] . '?status=ok');
exit;
