<?php

include("../definitions/definitions.php");

class language {
    
    public function show_language_list() {
        $return='<div id="box4"> <div>Ime: <input id="language_name"></input></div>';
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $return.='<br>Kratica: <input id="language_short"></input><br><button onclick="new_language()">Spremi</button></div>';
        $response=mysql_query("SELECT * FROM languages");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<div id="'.$row['id'].'"><div id="listel">Ime: "'.$row['name'].'"<br><div id="del"><button onclick="delete_language('.$row['id'].')">X</button></div></div></div>';
        }
        mysql_close($connection);
        return $return;
    }
    
    public function insert_language($name, $short) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO languages(name, short) VALUES('".$name."','".$short."')");
        $response=mysql_query("SELECT * FROM languages ORDER BY id DESC");
        $row=mysql_fetch_array($response, MYSQL_ASSOC);
        mysql_query("ALTER TABLE posts ADD (title".$row['id']." VARCHAR(100), content".$row['id']." TEXT)");
        mysql_query("ALTER TABLE pages ADD name".$row['id']." VARCHAR(100)");
        mysql_close($connection);
        return("Unos uspješno obavljen");
    }
    
    public function delete_language($id) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("ALTER TABLE posts DROP COLUMN title".$id."");
        mysql_query("ALTER TABLE posts DROP COLUMN content".$id.")");
        mysql_query("ALTER TABLE pages DROP COLUMN name".$id);
        mysql_query("DELETE FROM languages WHERE id='".$id."'");
        mysql_close($connection);
        return "Uspješno obrisano";
    }
    
    public function language_bar_show() {
        $return='';
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM languages");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<button onclick="choose_language('.$row['id'].')">'.$row['short'].'</button>';
        }
        mysql_close($connection);
        return $return;
    }
    
    public function language_init() {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM languages ORDER BY id DESC");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
           $return=$row['id'];
        }
        mysql_close($connection);
        return utf8_encode($return);
    }
    
}
?>