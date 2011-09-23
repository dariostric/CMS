<?php
include("../class/page_class.php");


$idpage= $_POST['id'];
$language= $_POST['language'];

$page= new page;
$page->show_page((int)$idpage, (int)$language);

?>