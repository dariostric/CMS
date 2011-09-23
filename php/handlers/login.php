<?php

$username= $_POST['username'];
$password= $_POST['password'];

if($username=="admin" && $password=="1234") {
    echo "yes";
} else {
    echo "no";
}

?>