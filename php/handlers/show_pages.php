<?php

include("../class/page_class.php");

$pageid=$_POST['page'];


$page= new page;
if((int)$pageid==0) {
    echo $page->show_page_list();
} else {
    echo $page->show_page_change($pageid);
}

?>