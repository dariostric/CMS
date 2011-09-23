<?php

include("php/definitions/definitions.php");

$connection=mysql_connect(DB_HOST,DB_USER,DB_PASS);
mysql_select_db(DB_NAME);

mysql_query("CREATE TABLE data(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id), link VARCHAR(100))");
mysql_query("CREATE TABLE data_post(data_id INT, post_id INT)");
mysql_query("CREATE TABLE image_post(img_id INT, post_id INT, width INT, kind INT)");
mysql_query("CREATE TABLE images(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id), link VARCHAR(100), name VARCHAR(100))");
mysql_query("CREATE TABLE languages(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id), name VARCHAR(100), short VARCHAR(10))");
mysql_query("CREATE TABLE pages(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id), number INT, underpage INT)");
mysql_query("CREATE TABLE posts(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id), date VARCHAR(20), page INT, type INT)");

mysql_close($connection);

?>