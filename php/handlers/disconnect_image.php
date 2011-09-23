<?php
include("../class/post_class.php");

$postid= $_POST['postid'];
$imgid= $_POST['imgid'];

$post= new post;
$post->disconnect_image($postid, $imgid);
?>