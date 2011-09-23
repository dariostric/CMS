<?php
include("../class/page_class.php");

$pageid= $_POST['page'];

$page = new page();
echo $page->delete_page((int)$pageid);
?>