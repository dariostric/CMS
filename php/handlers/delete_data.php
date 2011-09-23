<?php
include("../class/data_class.php");
include("../definitions/definitions.php");

$dataid= $_POST['data'];

$data = new data();
echo $data->delete_data((int)$dataid);
?>