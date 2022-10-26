<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $country, $email, $gender, $password){
    $conn = db();
    $result = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email'");
    if(mysqli_num_rows($result)<1) {
        $data = mysqli_query($conn, "INSERT INTO students (full_names, country, email, gender, password) VALUES('$fullnames', '$country', '$email', '$gender', '$password')");
        if($data){
            echo "User successfully registered";
        }else{
            echo "user not registered";
        }
    }else{
        header("Location:../forms/register.html");
    }

}


//login users
function loginUser($email, $password){
    $conn = db();

    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";

    $result = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email'");
    if(mysqli_num_rows($result)>0) {
        $chk = mysqli_fetch_array($result);
        $pass = $chk['password'];
        if($pass == $password){

            $username = $chk['full_names'];
            session_start();
            $_SESSION['username'] = $username;
            header("Location:../dashboard.php");
        }else{
            echo "password incorrect";
        }
        
    }else{
        echo "user does not exist";
    }
}


function resetPassword($email, $password){
    $conn = db();
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";

    $result = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email'");
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result)>0) {
        $chk = mysqli_query($conn, "UPDATE students SET password ='$password' WHERE email ='$email'");
        if($chk){
            echo "Update succesfully";
            //echo $password;
            //header("location: ../dashboard.php");
        }
        
    }else{
        echo "Update unsuccessful";
        //header("location: ../resetpassword.html");
    }
}


function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</td></form></tr>";
        }
        echo "</table></table></center></body></html>";
    }
    
}

 function deleteaccount($id){
     $conn = db();

    $delete = mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    if($delete){
        echo "user deleted successfully";
    }else{
        echo "user not deleted successfully";
    }
 }
