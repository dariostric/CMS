



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIG d.d. Slike</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="../js/jQuery/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.MultiFile.js"></script>
<script type="text/javascript" src="../js/functions/admin.js"></script>
<script type="text/javascript" src="../js/handlers/image_show.js"></script>
</head>
<body>
    <div id="headcont">
        <div id="header">
            <div id="title">
                Slike
            </div>
        </div>
        </div>
    <div id="container">
        <div id="main">
            <div id="box5">
                <?php
                    if(isset($_POST['upload']))
                    {
                        $uploaddir = '../images/';
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
                                    include("../php/class/images_class.php");
                                    
                                    $image = new image();
                                    $image->new_image($uploaddir.$name);
                                    echo "Slika uspješno učitana.<br/>";
                                }
                                else
                                {
                                    echo "Slika neuspješno učitana.<br/>";
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