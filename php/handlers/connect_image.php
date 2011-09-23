<?php
include("../class/post_class.php");

$postid= $_POST['postid'];
$imgid= $_POST['imgid'];
$kind= $_POST['kind'];
$width= $_POST['width'];

$post= new post;
$post->connect_image($postid, $imgid, $kind, $width);
?>