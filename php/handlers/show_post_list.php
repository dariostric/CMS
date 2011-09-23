<?php

include("../class/post_class.php");

$page_id= $_POST['page_id'];

$post= new post;
echo $post->show_post_list((int)$page_id);

?>