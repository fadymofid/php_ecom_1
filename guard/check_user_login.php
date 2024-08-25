<?php

function check_login(){
    if(!(isset($_SESSION['id']))){
        header('location:login.php');
    }
}

function check_admin_login(){
    if((!(isset($_SESSION['id'])))&& $_SESSION['type']!='admin'){
        header('location:login.php');
    }
}