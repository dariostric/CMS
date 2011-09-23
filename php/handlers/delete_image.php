<?php
include("../class/images_class.php");
include("../definitions/definitions.php");

$imageid= $_POST['image'];

$image = new image();
echo $image->delete_image((int)$imageid);
?>