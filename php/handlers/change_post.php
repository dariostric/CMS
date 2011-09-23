<?php
include("../class/post_class.php");

$postid= $_POST['post'];
$title= $_POST['title'];
$content= $_POST['content'];
$page= $_POST['page'];
$type= $_POST['type'];

$post = new post();
echo $post->change_post((int)$postid,$title,$content,(int)$page,(int)$type);

?>