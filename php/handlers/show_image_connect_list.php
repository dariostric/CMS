<?php

include("../class/images_class.php");
include("../definitions/definitions.php");

$postid= $_POST['postid'];

$image= new image;
echo $image->show_image_connect_list($postid);

?>