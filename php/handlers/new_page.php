<?php
include("../class/page_class.php");


$number= $_POST['number'];
$underpage= $_POST['underpage'];
$language= $_POST['language'];

$page = new page();

echo $page->insert_page( $number, (int)$underpage, $language);
?>