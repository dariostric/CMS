<?php

include("../class/data_class.php");
include("../definitions/definitions.php");

$postid= $_POST['postid'];

$data= new data;
echo $data->show_data_connect_list($postid);

?>