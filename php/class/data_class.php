<?php



class data {
    
    public function new_data($name) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO data(link) VALUES('".$name."')");
        mysql_close($connection);
    }
    
    public function show_data_list() {
        $return="";
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM data");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<div id="'.$row['id'].'"><div id="listel">Ime datoteke:<a href="'.$row['link'].'" target="_blank"> '. substr( $row['link'] , 8).'</a><br><div id="del"><button onclick="delete_data('.$row['id'].')">X</button></div></div></div>';
        }
        mysql_close($connection);
        return $return;
    }
    
    public function delete_data($data) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM data where id='".$data."'");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            unlink("../".$row['link']);
        }
        mysql_query("DELETE FROM data WHERE id='".$data."'");
        mysql_query("DELETE FROM data_post WHERE data_id='".$data."'");
        mysql_close($connection);
        return "Uspješno obrisano";
    }
    
    public function show_data_connect_list($postid) {
        $return='';
        $array= array();
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM data_post WHERE post_id='".$postid."'");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            array_push($array, $row['data_id']);
        }
        
        $response=mysql_query("SELECT * FROM data");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            if(in_array($row['id'], $array)) {
            $return.='<div id="datasel'.$row['id'].'"><div id="listel">Ime datoteke:<a href="'.$row['link'].'" target="_blank"> '. substr( $row['link'] , 10).'</a><br>
            <button onclick="disconnect_data('.$row['id'].','.$postid.')">Odvoji</button></div></div>';
            } else {
            $return.='<div id="imgsel'.$row['id'].'"><div id="listel">Ime datoteke:<a href="'.$row['link'].'" target="_blank"> '. substr( $row['link'] , 10).'</a><br>
            <button onclick="connect_data('.$row['id'].', '.$postid.')">Dodaj</button></div></div>';
            }
        }
        
        mysql_close($connection);
        return $return;
    }
}
?>