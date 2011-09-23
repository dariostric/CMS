<?php
include("../class/page_class.php");


$number= $_POST['number'];
$underpage= $_POST['underpage'];
$language= $_POST['language'];
$pageid=$_POST['pageid'];

$page = new page();
echo $page->change_page( $number, (int)$underpage, $language, $pageid);
?>