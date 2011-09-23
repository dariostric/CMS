<?php
include("../class/language_class.php");


$name= $_POST['name'];
$short= $_POST['short'];

$language = new language();

echo $language->insert_language($name, $short);
?>