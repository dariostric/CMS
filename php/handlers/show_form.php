<?php
error_reporting(0);
include("../class/post_class.php");
include("../class/page_class.php");


$post = new post();
echo $post->show_form_post();
?>