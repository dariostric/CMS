<?php


class image {
    
    public function new_image($name) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO images(link) VALUES('".$name."')");
        mysql_close($connection);
    }
    
    public function show_image_list() {
        $return="";
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM images");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<div id="'.$row['id'].'"><div id="listel">Ime datoteke:<a href="'.$row['link'].'" target="_blank"> '. substr( $row['link'] , 10).'</a><br><div id="del"><button onclick="delete_image('.$row['id'].')">X</button></div></div></div>';
        }
        mysql_close($connection);
        return $return;
    }
    
    public function delete_image($image) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM images where id='".$image."'");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            unlink("../".$row['link']);
        }
        mysql_query("DELETE FROM images WHERE id='".$image."'");
        mysql_query("DELETE FROM image_post WHERE img_id='".$image."'");
        mysql_close($connection);
        return "Uspješno obrisano";
    }
    
    public function show_image_connect_list($postid) {
        $return='';
        $array= array();
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM image_post WHERE post_id='".$postid."'");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            array_push($array, $row['img_id']);
        }
        
        $response=mysql_query("SELECT * FROM images");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            if(in_array($row['id'], $array)) {
            $return.='<div id="imgsel'.$row['id'].'"><div id="listel">Ime datoteke:<a href="'.$row['link'].'" target="_blank"> '. substr( $row['link'] , 10).'</a><br>
            <button onclick="disconnect_image('.$row['id'].','.$postid.')">Odvoji</button></div></div>';
            } else {
            $return.='<div id="imgsel'.$row['id'].'"><div id="listel">Ime datoteke:<a href="'.$row['link'].'" target="_blank"> '. substr( $row['link'] , 10).'</a><br>
            Širina:
            <select id="width'.$row['id'].'">
            <option value="100">100px</option>
            <option value="200">200px</option>
            <option value="300">300px</option>
            <option value="400">400px</option>
            <option value="500">500px</option>
            </select>
             Vrsta:
            <select id="kind'.$row['id'].'">
            <option value="1">Lijevo</option>
            <option value="2">Desno</option>
            <option value="3">Centrirano</option>
            </select>
            <button onclick="connect_image('.$row['id'].', '.$postid.')">Dodaj</button></div></div>';
            }
        }
        
        mysql_close($connection);
        return $return;
    }
}
?>