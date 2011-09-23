<?php
include("../class/language_class.php");

$languageid= $_POST['language'];

$language = new language();
echo $language->delete_language((int)$languageid);
?>