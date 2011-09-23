<?php

include("../definitions/definitions.php");

class post {
    
    public function show_post_list($id) {
        $return="";
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
         $response1=mysql_query("SELECT * FROM languages");
         $response=mysql_query("SELECT * FROM posts WHERE page='".$id."'");
        while ($row1=mysql_fetch_array($response1, MYSQL_ASSOC)) {
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<div id="'.$row['id'].'"><div id="listel">
            <a>Naslov: '.$row['title'.$row1['id']].'</a><br>
            <a> Objavljeno: '.$row['date'].'</a><div id="del">
            <button onclick="delete_post('.$row['id'].')">X</button></div>
            <button onclick="show_change_post('.$row['id'].')">Promijeni</button><button onclick="show_connect_data('.$row['id'].')">Uredi datoteke</button>'.
            '<button onclick="show_connect_image('.$row['id'].')">Uredi slike</button></div></div>';
        }
        }
        mysql_close($connection);
        return $return;
    }
    
    public function insert_post($title, $content, $date, $page, $type) {
        $str1="";
        $str2="";
        $str3="";
        $str4="";
        $arr=explode("|", $title);
        $count = count($arr);
        for($i=0; $i<$count-1; $i+=2) {
            $str1.="title".$arr[$i].",";
            $str2.="'".$arr[$i+1]."',";
        }
        $arr=explode("|", $content);
        $count = count($arr);
        for($i=0; $i<$count-1; $i+=2) {
            $str3.="content".$arr[$i].",";
            $str4.="'".$arr[$i+1]."',";
        }
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO posts(".$str1.$str3." date, page, type) VALUES(".$str2.$str4."'".$date."','".$page."','".$type."')");
        mysql_close($connection);
        return("Unos uspješno obavljen");
    }
    
    public function delete_post($post) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("DELETE FROM posts WHERE id='".$post."'");
        mysql_close($connection);
        return "Uspješno obrisano";
    }
    
    public function show_change_post($post) {
    $return='<div id="postinput">';
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $page = new page;
        $response1=mysql_query("SELECT * FROM languages");
        $response=mysql_query("SELECT * FROM posts WHERE id='".$post."'");
        $row=mysql_fetch_array($response, MYSQL_ASSOC);
        while ($row1=mysql_fetch_array($response1, MYSQL_ASSOC)) {
                $return.='<p>Naslov('.$row1['short'].'):</p> <input id="posttitle'.$row1['id'].'" value="'.$row['title'.$row1['id']].'"></input>'.
                        '<p>Tekst('.$row1['short'].'):</p> <textarea id="posttext'.$row1['id'].'">'.$row['content'.$row1['id']].'</textarea>';
        }
                    $return.='Objavi na stranici: <select id="pageid">'.
                            $page->form_page($row['page']).
                          '</select>'.
                          'Vrsta prikaza: <select id="posttype">'.
                            '<option value="1">Cijeli post</option>'.
                            '<option value="2">Pola posta</option>'.
                          '</select>'.
                          '<br>'.
                          '<button id="submitpost" onclick="change_post('.$row['id'].')">Unesi</button>'.
                        '</div>';    
        mysql_close($connection);
        return utf8_encode ($return);
    }
    
    public function show_form_post($post) {
        $return='<div id="postinput">';
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $page = new page;
        $response=mysql_query("SELECT * FROM languages");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<p>Naslov('.$row['short'].'):</p> <input id="posttitle'.$row['id'].'"></input>'.
                        '<p>Tekst('.$row['short'].'):</p> <textarea id="posttext'.$row['id'].'"></textarea>';
        }
                    $return.='Objavi na stranici: <select id="pageid">'.
                            $page->form_page(0).
                          '</select>'.
                          'Vrsta prikaza: <select id="posttype">'.
                            '<option value="1">Cijeli post</option>'.
                            '<option value="2">Pola posta</option>'.
                          '</select>'.
                          '<br>'.
                          '<button id="submitpost" onclick="submit_post()">Unesi</button>'.
                        '</div>';    
        mysql_close($connection);
        return utf8_encode ($return);
    }
    
    public function change_post($post, $title, $content, $page, $type) {
        
        $str1="";
        $str3="";
        $arr=explode("|", $title);
        $count = count($arr);
        for($i=0; $i<$count-1; $i+=2) {
            $str1.="title".$arr[$i]."='".$arr[$i+1]."',";
        }
        $arr=explode("|", $content);
        $count = count($arr);
        for($i=0; $i<$count-1; $i+=2) {
            $str3.="content".$arr[$i]."='".$arr[$i+1]."',";
        }

        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("UPDATE posts SET ".$str1.$str3." page='".$page."', type='".$type."' WHERE id='".$post."'");
        mysql_close($connection);
        return("Promjena uspješno obavljena");
    }
    
    public function connect_image($postid, $imageid, $kind, $width) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO image_post(img_id, post_id, kind, width) VALUES('".$imageid."','".$postid."','".$kind."','".$width."')");
        mysql_close($connection);
        
    }
    
    public function disconnect_image($postid, $imageid) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        mysql_query("DELETE FROM image_post WHERE img_id='".$imageid."' AND post_id='".$postid."'");
        mysql_close($connection);
        
    }
    
    public function connect_data($postid, $dataid) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO data_post(data_id, post_id) VALUES('".$dataid."','".$postid."')");
        mysql_close($connection);
        
    }
    
    public function disconnect_data($postid, $dataid) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        mysql_query("DELETE FROM data_post WHERE data_id='".$dataid."' AND post_id='".$postid."'");
        mysql_close($connection);
        
    }
}
?>