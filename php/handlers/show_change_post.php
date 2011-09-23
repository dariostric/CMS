<?php
error_reporting(0);
include("../class/post_class.php");
include("../class/page_class.php");


$postid=$_POST['post'];

$post = new post();
echo $post->show_change_post((int)$postid);
?>