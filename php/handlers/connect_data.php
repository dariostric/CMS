﻿<?php
include("../class/post_class.php");

$postid= $_POST['postid'];
$dataid= $_POST['dataid'];

$post= new post;
$post->connect_data($postid, $dataid);
?>