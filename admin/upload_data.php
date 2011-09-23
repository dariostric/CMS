



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIG d.d. Datoteke</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="../js/jQuery/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.MultiFile.js"></script>
<script type="text/javascript" src="../js/functions/admin.js"></script>
<script type="text/javascript" src="../js/handlers/data_show.js"></script>
</head>
<body>
    <div id="headcont">
        <div id="header">
            <div id="title">
                Datoteke
            </div>
        </div>
        </div>
    <div id="container">
        <div id="main">
            <div id="box5">
                <?php
                    if(isset($_POST['upload']))
                    {
                        $uploaddir = '../data/';
                        foreach ($_FILES["pic"]["error"] as $key => $error)
                        {
                            if ($error == UPLOAD_ERR_OK)
                            {
                                $tmp_name = $_FILES["pic"]["tmp_name"][$key];
                                $name = $_FILES["pic"]["name"][$key];
                                $uploadfile = $uploaddir . basename($name);
                     
                                if (move_uploaded_file($tmp_name, $uploadfile))
                                {
                                    include("../php/definitions/definitions.php");
                                    include("../php/class/data_class.php");
                                    
                                    $data = new data();
                                    $data->new_data($uploaddir.$name);
                                    echo "Datoteka uspješno učitana.<br/>";
                                }
                                else
                                {
                                    echo "Datoteka neuspješno učitana.<br/>";
                                }
                            }
                        }
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="pic[]" class="multi" />
                <input type="submit" name="upload" value="Upload" />
                </form>
            </div>
            <div id="box1">
            </div>
            </div>
        </div>
    </div>
    <div id="footer">
            <p>VIG d.d. &copy 2011</p>
    </div>
</body>
</html>