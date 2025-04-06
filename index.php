<?php
session_start();


if($_SERVER['REQUEST_URI'] == '/Sign-up-form-using-PHP-Superglobals/'){
    header("Location: views/signup");    
    die();
}
