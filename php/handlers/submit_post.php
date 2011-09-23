<?php
include("../class/post_class.php");
date_default_timezone_set('Europe/Zagreb');

$title= $_POST['title'];
$content= $_POST['content'];
$page= $_POST['page'];
$type= $_POST['type'];

$post = new post();

echo $post->insert_post($title,$content,date("d. m. Y."),(int)$page,(int)$type);
?>