<?php
include("../class/post_class.php");

$postid= $_POST['postid'];
$dataid= $_POST['dataid'];

$post= new post;
$post->disconnect_data($postid, $dataid);
?>