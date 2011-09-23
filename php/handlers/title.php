<?php

include("../class/page_class.php");

$language = $_POST['language'];
$id = $_POST['id'];
$page = new page();
$page->show_title((int)$id, $language);

?>