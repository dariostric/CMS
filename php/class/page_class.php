<?php

include("../definitions/definitions.php");

class page {
    
    public function show_menu($language) {
        $return="";
        $connection=mysql_connect(DB_HOST,DB_USER,DB_PASS);
        mysql_select_db(DB_NAME);
        if ($language==0) {
        $response1=mysql_query("SELECT * FROM languages");
        $row1=mysql_fetch_array($response1, MYSQL_ASSOC);
            $response=mysql_query("SELECT * FROM pages where underpage='0' ORDER BY id");
            while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
                $return.='<a id="menu'.$row['id'].'" onclick="show_interface('.$row['id'].','.$language.')" onmouseover="dropdown_engage('.$row['id'].','.$language.')">'.$row['name'.$row1['id']].'</a>';
            }
        } else {
            $response1=mysql_query("SELECT * FROM languages where id='".$language."'");
            while ($row1=mysql_fetch_array($response1, MYSQL_ASSOC)) {
            $response=mysql_query("SELECT * FROM pages where underpage='0' ORDER BY id");
            while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
                $return.='<a id="menu'.$row['id'].'" onclick="show_interface('.$row['id'].','.$language.')" onmouseover="dropdown_engage('.$row['id'].','.$language.')">'.$row['name'.$row1['id']].'</a>';
            }
        }
        }
        
        $return.='';
        mysql_close($connection);
        return $return;
    }
    
    public function show_page($id, $language) {
        
        $return="";
        $connection=mysql_connect(DB_HOST,DB_USER,DB_PASS);
        mysql_select_db(DB_NAME);
        if ($language!=0) {
        if($id==0) {
            $response=mysql_query("SELECT * FROM pages");
            $row=mysql_fetch_array($response, MYSQL_ASSOC);
            $id=$row['id'];
            
        }
        $number=1;
        
        $response=mysql_query("SELECT * FROM posts WHERE page='".$id."' ORDER BY id DESC");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return2="";
            $response2=mysql_query("SELECT * FROM image_post WHERE post_id='".$row['id']."'") or die();
                while ($row2=mysql_fetch_array($response2, MYSQL_ASSOC)) {
                    $response3=mysql_query("SELECT * FROM images WHERE id='".$row2['img_id']."'") or die();
                    while ($row3=mysql_fetch_array($response3, MYSQL_ASSOC)) {
                        if($row2['kind']==1) {
                            $return2.='<div id="imgleft"><img src="'.substr($row3['link'], 3).'" width="'.$row2['width'].'px"></div>';
                        } elseif($row2['kind']==2) {
                            $return2.='<div id="imgright"><img src="'.substr($row3['link'], 3).'" width="'.$row2['width'].'px"></div>';
                        } elseif($row2['kind']==3)
                            $return2.='<div id="imgcenter"><img src="'.substr($row3['link'], 3).'" width="'.$row2['width'].'px"></div>';
                    }
                }
                
            $return3="";
            $response2=mysql_query("SELECT * FROM data_post WHERE post_id='".$row['id']."'") or die();
                while ($row2=mysql_fetch_array($response2, MYSQL_ASSOC)) {
                    $response3=mysql_query("SELECT * FROM data WHERE id='".$row2['data_id']."'") or die();
                    while ($row3=mysql_fetch_array($response3, MYSQL_ASSOC)) {
                        $return3.='<div id="'.$row3['id'].'"><div id="listel"><a href="'.substr($row3['link'], 3).'" target="_blank"> '. substr( $row3['link'] , 8).'</a><br></div></div>';
                    }
                }
            
            if($row['type']==1){
                $return.='<div id="box1"><h1>'.$row['title'.$language].'</h1><hr>'.$return2.'<p>'.$row['content'.$language].'</p>'.$return3.'</div>';
            } elseif($row['type']==2 AND $number==1){
                $return.='<div id="boxcont"><div id="box2"><h1>'.$row['title'.$language].'</h1><hr>'.$return2.'<p>'.$row['content'.$language].'</p>'.$return3.'</div>';
                $number=2;
            } elseif($row['type']==2 AND $number==2){
                $return.='<div id="box3"><h1>'.$row['title'.$language].'</h1><hr>'.$return2.'<p>'.$row['content'.$language].'</p>'.$return3.'</div></div>';
                $number=1;
            }
        }}
        mysql_close($connection);
        
        echo utf8_encode ($return);
    }
    
    function form_page($id) {
        $return="";
        $return2='';
        $connection=mysql_connect(DB_HOST,DB_USER,DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM languages");
        $response2=mysql_query("SELECT * FROM pages");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            while ($row2=mysql_fetch_array($response2, MYSQL_ASSOC)) {
                if ($row2['id']!=$id) {
                    $return.='<option value="'.$row2['id'].'">'.$row2['name'.$row['id']].'</option>';
                } else {
                    $return2='<option value="'.$row2['id'].'">'.$row2['name'.$row['id']].'</option>';
                }
            }
        }
        
        mysql_close($connection);
        return $return2.$return;
    }
    
    function show_page_list() {
        $return1='<div id="box4">';
        $return2='';
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM languages");
        $response2=mysql_query("SELECT * FROM pages");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return1.=' <div id="inputhold">Ime('.$row['short'].'): <input id="page_name'.$row['id'].'"></input></div>';
            
            while ($row2=mysql_fetch_array($response2, MYSQL_ASSOC)) {
                $return2.='<div id="'.$row2['id'].'"><div id="listel">Ime('.$row['short'].'):'.$row2['name'.$row['id']].'<br><div id="del"><button onclick="delete_page('.$row2['id'].')">X</button></div><button onclick="show_pages('.$row2['id'].')">Promijeni</button></div></div>';
        }
        }
        
        $return1.='<br><div>Broj postova: <input id="page_number"></input></div><br>Podstranica: <select id="underpage"><option value="0">Meni</option>';
        
        $response=mysql_query("SELECT * FROM languages");
        $response2=mysql_query("SELECT * FROM pages");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            while ($row2=mysql_fetch_array($response2, MYSQL_ASSOC)) {
                $return1.='<option value="'.$row2['id'].'">'.$row2['name'.$row['id']].'</option>';
        }
        }
        
        
        $return1.='</select><br>';
        
        $return1.='<br><button onclick="new_page()">Spremi</button></div>';
        
        mysql_close($connection);
        return $return1.$return2;
    }
    
    function insert_page($number, $underpage, $language) {
        $str1="";
        $str2="";
        $arr=explode("|", $language);
        $count = count($arr);
        for($i=0; $i<$count-1; $i+=2) {
            $str1.="name".$arr[$i].",";
            $str2.="'".$arr[$i+1]."',";
        }
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("INSERT INTO pages(".$str1." number, underpage) VALUES(".$str2."'".$number."','".$underpage."')");
        mysql_close($connection);
        return("Unos uspješno obavljen");
    
    }
    
    public function delete_page($page) {
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("DELETE FROM posts WHERE page='".$page."'");
        mysql_query("DELETE FROM pages WHERE id='".$page."' OR underpage='".$page."'");
        mysql_close($connection);
        return "Uspješno obrisano";
    }
    
    public function show_underpage($page, $language) {
        $return='<div id="undermenuhold">';
        $connection=mysql_connect(DB_HOST,DB_USER,DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM pages where underpage='".$page."'");
        while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
            $return.='<a id="menu'.$row['id'].'" onclick="show_interface('.$row['id'].', '.$language.')">'.$row['name'.$language].'</a>';
        }
        $return.='</div>';
        mysql_close($connection);
        return $return;
    }
    
    public function show_title($id, $language) {
       $language= utf8_encode ($language);
        $connection=mysql_connect(DB_HOST,DB_USER,DB_PASS);
        mysql_select_db(DB_NAME);
        if($id==0) {
            $response=mysql_query("SELECT * FROM pages");
            $row=mysql_fetch_array($response, MYSQL_ASSOC);
            $id=$row['id'];
            
        }
        $return="";

            $response=mysql_query("SELECT * FROM pages where id='".$id."'");
            $row=mysql_fetch_array($response, MYSQL_ASSOC);
            $return=$row["name".$language];

        mysql_close($connection);
        echo $return;
    }
    
    public function show_page_change($pageid) {
        $return1='<div id="box4">';
        $return2='';
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $response=mysql_query("SELECT * FROM languages");
        $response2=mysql_query("SELECT * FROM pages WHERE id='".$pageid."'");
            while ($row2=mysql_fetch_array($response2, MYSQL_ASSOC)) {
                while ($row=mysql_fetch_array($response, MYSQL_ASSOC)) {
                $return1.=' <div id="inputhold">Ime('.$row['short'].'): <input id="page_name'.$row['id'].'" value="'.$row2['name'.$row['id']].'"></input></div>';
                $number=$row2['number'];
        }
        }
        
        $return1.='<br><div>Broj postova: <input id="page_number" value="'.$number.'"></input></div><br>';
        $return1.='<br><button onclick="change_page('.$pageid.')">Spremi</button></div>';
        
        mysql_close($connection);
        return $return1.$return2;
    }
    
    public function change_page($number, $underpage, $language, $pageid) {
        $str1="";
        $str2="";
        $arr=explode("|", $language);
        $count = count($arr);
        for($i=0; $i<$count-1; $i+=2) {
            $str1.="name".$arr[$i]."='".$arr[$i+1]."',";
        }
        $connection=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Nemoguće se spojiti na bazu, molimo vas kontaktirajte administratora stranice");
        mysql_select_db(DB_NAME);
        mysql_query("UPDATE pages SET ".$str1." number='".$number."', underpage='".$underpage."' WHERE id='".$pageid."'");
        mysql_close($connection);
        return("Unos uspješno obavljen");
    
    }
}
?>