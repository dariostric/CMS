<?php

include("../class/page_class.php");

$language = $_POST['language'];

$page = new page();
echo $page->show_menu((int)$language);

?>