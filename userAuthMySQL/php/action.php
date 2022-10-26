<?php
include "userauth.php";
include_once "../config.php";


switch (true) {
    case isset($_POST['register']):
        $fullnames = $_POST['fullnames'];
        $country = $_POST['country'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        registerUser($fullnames, $country, $email, $gender, $password);
        break;

    case isset($_POST['login']):
        $email = $_POST['email'];
            $password = $_POST['password'];
            loginUser($email, $password);
        break;

    case isset($_POST["reset"]):
        $email = $_POST['email'];
            $password = $_POST['password'];
            resetPassword($email, $password);
        break;
    case isset($_POST["delete"]):
        $id = $_POST['id'];
        deleteaccount($id);
        break;
    case isset($_GET["all"]):
        getusers();
        break;
}
