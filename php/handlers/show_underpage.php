<?php
include("../class/page_class.php");

$pageid= $_POST['page'];
$language = $_POST['language'];

$page = new page();
echo $page->show_underpage((int)$pageid, (int)$language);
?>