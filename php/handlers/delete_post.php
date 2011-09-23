<?php
include("../class/post_class.php");

$page= $_POST['post'];

$post = new post();
echo $post->delete_post((int)$page);
?>